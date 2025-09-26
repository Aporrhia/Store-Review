@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<div class="container mx-auto max-w-3xl p-4">
    <h1 class="text-2xl font-bold mb-6">My Cart</h1>
    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    @if($items->isEmpty())
        <div class="text-gray-500">Your cart is empty.</div>
    @else
        <div class="bg-white rounded shadow p-4">
            <table class="w-full text-left mb-4">
                <thead>
                    <tr>
                        <th class="py-2">Item</th>
                        <th class="py-2">Quantity</th>
                        <th class="py-2">Price</th>
                        <th class="py-2">Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($items as $item)
                        @php $total = ($item->listing->price ?? 0) * $item->quantity; $grandTotal += $total; @endphp
                        <tr class="border-b">
                            <td class="py-2">
                                <div class="font-semibold">{{ $item->listing->title ?? 'Listing #' . $item->listing_id }}</div>
                            </td>
                            <td class="py-2">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99" class="w-16 border rounded px-2 py-1">
                                    <button type="submit" class="text-xs bg-lime-500 text-white rounded px-2 py-1 hover:bg-lime-600">Update</button>
                                </form>
                            </td>
                            <td class="py-2">{{ number_format($item->listing->price ?? 0, 2) }}</td>
                            <td class="py-2">{{ number_format($total, 2) }}</td>
                            <td class="py-2">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs text-red-600 hover:underline">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right font-bold text-lg">Grand Total: {{ number_format($grandTotal, 2) }}</div>
        </div>
    @endif
</div>
@endsection
