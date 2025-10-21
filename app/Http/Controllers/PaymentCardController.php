<?php

namespace App\Http\Controllers;

use App\Models\PaymentCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentCardController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        View::share('cards', PaymentCard::where('user_id', Auth::id())->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string|size:16',
            'expiry_date' => [
                'required',
                'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/',
                function ($attribute, $value, $fail) {
                    $currentYear = (int) date('y');
                    $currentMonth = (int) date('m');
                    [$month, $year] = explode('/', $value);
                    if ((int) $year < $currentYear || ((int) $year === $currentYear && (int) $month < $currentMonth)) {
                        $fail('The expiry date must be in the future.');
                    }
                },
            ],
            'cardholder_name' => 'required|string|max:255',
            'security_code' => 'required|string|size:3',
        ]);

        PaymentCard::create([
            'user_id' => Auth::id(),
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'cardholder_name' => $request->cardholder_name,
            'security_code' => $request->security_code,
        ]);

        return redirect()->route('profile.paymentCards', ['id' => Auth::id()])->with('success', 'Card added successfully.');
    }

    // public function index()
    // {
    //     $user = Auth::user();
    //     $cards = PaymentCard::where('user_id', $user->id)->get();
    //     return view('profile.sections.payment_cards', compact('user', 'cards'));
    // }

    public function edit(PaymentCard $paymentCard)
    {
        $user = Auth::user();
        if (auth()->user()->id !== $paymentCard->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('profile.sections.payment_cards', compact('paymentCard', 'user'));
    }

    public function update(Request $request, PaymentCard $paymentCard)
    {
        if (auth()->user()->id !== $paymentCard->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'card_number' => 'required|string|size:16',
            'expiry_date' => [
                'required',
                'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/',
                function ($attribute, $value, $fail) {
                    $currentYear = (int) date('y');
                    $currentMonth = (int) date('m');
                    [$month, $year] = explode('/', $value);
                    if ((int) $year < $currentYear || ((int) $year === $currentYear && (int) $month < $currentMonth)) {
                        $fail('The expiry date must be in the future.');
                    }
                },
            ],
            'cardholder_name' => 'required|string|max:255',
            'security_code' => 'required|string|size:3',
        ]);

        $paymentCard->update($request->only('card_number', 'expiry_date', 'cardholder_name', 'security_code'));

        return redirect()->route('profile.paymentCards', ['id' => Auth::id()])->with('success', 'Card updated successfully.');
    }

    public function destroy(PaymentCard $paymentCard)
    {
        if (auth()->user()->id !== $paymentCard->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $paymentCard->delete();

        return redirect()->route('profile.paymentCards', ['id' => Auth::id()])->with('success', 'Card deleted successfully.');
    }
}