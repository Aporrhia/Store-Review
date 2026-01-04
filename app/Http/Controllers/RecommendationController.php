<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Listing;

class RecommendationController extends Controller
{
    public function recommend(Request $request)
    {
        // Load deterministic synthetic purchase history from storage/app/recommendation_history.php
        // This file returns an array of orders (each order is an array of listing IDs).
        $ordersFile = storage_path('app/recommendation_history.php');
        if (file_exists($ordersFile)) {
            $orders = include $ordersFile;
            if (!is_array($orders)) $orders = [];
        } else {
            // fallback: empty
            $orders = [];
        }

        // --- Read actual input from request ---
        $raw = $request->input('items', null);
        if (is_array($raw)) {
            $inputListingIds = array_values(array_filter(array_map(function ($v) {
                return is_numeric($v) ? (int)$v : null;
            }, $raw)));
        } elseif (is_string($raw) && trim($raw) !== '') {
            $parts = preg_split('/[\s,]+/', trim($raw));
            $inputListingIds = array_values(array_filter(array_map(function ($v) {
                return is_numeric($v) ? (int)$v : null;
            }, $parts)));
        } else {
            $inputListingIds = [];
        }

        // Build universe from orders and include input ids so newVec isn't empty
        $allItemIds = [];
        foreach ($orders as $ord) {
            foreach ($ord as $lid) $allItemIds[$lid] = true;
        }
        foreach ($inputListingIds as $lid) {
            if (is_numeric($lid)) $allItemIds[(int)$lid] = true;
        }

        $items = array_keys($allItemIds);
        sort($items, SORT_NUMERIC);
        if (empty($items)) {
            // nothing to recommend from
            return response()->json(['mode' => 'static-test', 'orders' => $orders, 'items' => [], 'recommended' => []]);
        }

        // Map item id => index and build binary vectors
        $itemIndex = array_flip($items);
        $m = count($items);
        $purchase_history = [];
        foreach ($orders as $ord) {
            $vec = array_fill(0, $m, 0);
            foreach ($ord as $lid) {
                if (isset($itemIndex[$lid])) $vec[$itemIndex[$lid]] = 1;
            }
            $purchase_history[] = $vec;
        }

        // Build input vector
        $newVec = array_fill(0, $m, 0);
        foreach ($inputListingIds as $lid) {
            if (isset($itemIndex[$lid])) $newVec[$itemIndex[$lid]] = 1;
        }

        // cosine helper
        $cosine = function(array $v1, array $v2) {
            $dot = 0; $n1 = 0; $n2 = 0; $len = count($v1);
            for ($i = 0; $i < $len; $i++) { $dot += $v1[$i] * $v2[$i]; $n1 += $v1[$i]*$v1[$i]; $n2 += $v2[$i]*$v2[$i]; }
            if ($n1 == 0 || $n2 == 0) return 0.0;
            return $dot / (sqrt($n1) * sqrt($n2));
        };

        // similarities
        $sims = [];
        foreach ($purchase_history as $idx => $vec) {
            $sims[$idx] = $cosine($newVec, $vec);
        }

        // choose top orders with positive similarity
        arsort($sims);
        $topN = 3; $topIndices = [];
        foreach ($sims as $idx => $score) {
            if ($score > 0) { $topIndices[] = $idx; if (count($topIndices) >= $topN) break; }
        }

        // combine with weighting by similarity
        $combined = array_fill(0, $m, 0.0);
        foreach ($topIndices as $ti) {
            $weight = $sims[$ti] ?? 1.0;
            foreach ($purchase_history[$ti] as $i => $val) {
                if ($val) $combined[$i] += $val * $weight;
            }
        }

        // zero out input items
        for ($i = 0; $i < $m; $i++) { if ($newVec[$i] == 1) $combined[$i] = 0; }

        // rank
        $recommendMap = [];
        foreach ($combined as $i => $count) { if ($count > 0) $recommendMap[$items[$i]] = $count; }
        arsort($recommendMap);
        $recLimit = 4; $recommendedListingIds = array_slice(array_keys($recommendMap), 0, $recLimit);

            // If no recommendations found via similarity/weights, use co-occurrence or global frequency as deterministic fallback
            if (empty($recommendedListingIds)) {
                // build frequency and co-occurrence maps from orders
                $freq = [];
                $coocc = []; // coocc[item][other] = count
                foreach ($orders as $ord) {
                    $unique = array_values(array_unique($ord));
                    foreach ($unique as $i) {
                        if (!isset($freq[$i])) $freq[$i] = 0;
                        $freq[$i]++;
                    }
                    $n = count($unique);
                    for ($a = 0; $a < $n; $a++) {
                        for ($b = 0; $b < $n; $b++) {
                            if ($a === $b) continue;
                            $ia = $unique[$a]; $ib = $unique[$b];
                            if (!isset($coocc[$ia])) $coocc[$ia] = [];
                            if (!isset($coocc[$ia][$ib])) $coocc[$ia][$ib] = 0;
                            $coocc[$ia][$ib]++;
                        }
                    }
                }

                $scores = [];
                // Sum co-occurrence scores for each input id
                foreach ($inputListingIds as $lid) {
                    if (isset($coocc[$lid])) {
                        foreach ($coocc[$lid] as $other => $count) {
                            if (in_array($other, $inputListingIds)) continue;
                            if (!isset($scores[$other])) $scores[$other] = 0;
                            $scores[$other] += $count;
                        }
                    }
                }

                // If scores empty (input ids never appear), fall back to global frequency
                if (empty($scores)) {
                    foreach ($freq as $id => $c) {
                        if (in_array($id, $inputListingIds)) continue;
                        $scores[$id] = $c;
                    }
                }

                if (!empty($scores)) {
                    arsort($scores);
                    $recommendedListingIds = array_slice(array_keys($scores), 0, $recLimit);
                }
            }

            // Ensure we have up to 3 recommendations: if fewer, fill deterministically but varying by input
            $desired = 3;
            if (count($recommendedListingIds) < $desired) {
                // compute frequency map if not yet available
                if (!isset($freq)) {
                    $freq = [];
                    foreach ($orders as $ord) {
                        foreach (array_values(array_unique($ord)) as $i) { $freq[$i] = ($freq[$i] ?? 0) + 1; }
                    }
                }

                // Prepare ordered candidate list by frequency (desc)
                arsort($freq);
                $freqKeys = array_keys($freq);

                // Determine deterministic start offset based on input ids to vary results per item
                // Use crc32 hash of the input ids string for better dispersion
                $offset = 0;
                if (!empty($inputListingIds) && !empty($freqKeys)) {
                    $keyStr = implode(',', $inputListingIds);
                    $offset = (int) (crc32($keyStr) & 0xffffffff) % count($freqKeys);
                }

                // iterate freqKeys starting at offset, wrap around, pick candidates
                $n = count($freqKeys);
                for ($k = 0; $k < $n && count($recommendedListingIds) < $desired; $k++) {
                    $idx = ($offset + $k) % $n;
                    $cand = $freqKeys[$idx];
                    if (in_array($cand, $inputListingIds)) continue;
                    if (in_array($cand, $recommendedListingIds)) continue;
                    $recommendedListingIds[] = $cand;
                }

                // if still not enough, pull from DB listing ids deterministically starting from input-based offset
                if (count($recommendedListingIds) < $desired) {
                    $allListingIds = Listing::query()->orderBy('id', 'asc')->pluck('id')->toArray();
                    $nAll = count($allListingIds);
                    $start = 0;
                    if (!empty($inputListingIds) && $nAll > 0) {
                        $keyStr = implode(',', $inputListingIds);
                        $start = (int) (crc32($keyStr) & 0xffffffff) % $nAll;
                    }
                    for ($k = 0; $k < $nAll && count($recommendedListingIds) < $desired; $k++) {
                        $cand = $allListingIds[($start + $k) % $nAll];
                        if (in_array($cand, $inputListingIds)) continue;
                        if (in_array($cand, $recommendedListingIds)) continue;
                        $recommendedListingIds[] = $cand;
                    }
                }
            }

        // fetch details
        $listings = Listing::whereIn('id', $recommendedListingIds)->get()->keyBy('id');
        $recommended = [];
        foreach ($recommendedListingIds as $lid) {
            $listing = $listings->get($lid);
            $recommended[] = [
                'listing_id' => $lid,
                'title' => optional($listing)->storeItem->title ?? 'listing_'.$lid,
                'image' => optional(optional($listing)->storeItem)->getImageUrl() ?? null,
                'price' => optional($listing)->price ?? null,
                // add metadata so the frontend can display category, brand and seller
                'category' => optional(optional($listing)->storeItem->category)->name ?? '',
                'brand' => optional(optional($listing)->storeItem->brand)->name ?? 'N/A',
                'seller_id' => optional($listing->user)->id ?? null,
                'seller_name' => optional($listing->user)->name ?? null,
            ];
        }

        Log::info('Recommendation debug', [
            'orders' => $orders,
            'items' => $items,
            'input' => $inputListingIds,
            'similarities' => $sims,
            'recommendMap' => $recommendMap,
            'recommended' => $recommended,
        ]);

        return response()->json([
            'mode' => 'static-test',
            'orders' => $orders,
            'items' => $items,
            'input' => $inputListingIds,
            'similarities' => $sims,
            'recommendMap' => $recommendMap,
            'recommended' => $recommended,
        ]);
    }
}