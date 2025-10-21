@extends('profile.layout')

@section('title', 'Manage Payment Cards')

@section('profile-content')
<div class="bg-gray-50 font-sans">
    <div class="container mx-auto max-w-7xl p-4 sm:p-6 lg:p-8">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Manage Payment Cards</h2>

            <!-- Add New Card Form -->
            <form action="{{ isset($paymentCard) ? route('payment-cards.update', $paymentCard) : route('payment-cards.store') }}" method="POST" class="mb-8">
                @csrf
                @if(isset($paymentCard))
                    @method('PUT')
                @endif
                <div class="space-y-6">
                    <!-- Card Number -->
                    <div>
                        <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                        <input type="text" name="card_number" id="card_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" required maxlength="16" pattern="\d{16}" title="Card number must be 16 digits" value="{{ old('card_number', $paymentCard->card_number ?? '') }}" oninput="this.value = this.value.replace(/[^\d]/g, '')">
                        @error('card_number')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cardholder Name -->
                    <div>
                        <label for="cardholder_name" class="block text-sm font-medium text-gray-700">Cardholder Name</label>
                        <input type="text" name="cardholder_name" id="cardholder_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" required maxlength="255" pattern="[A-Za-z ]+" title="Name must contain only letters and spaces" value="{{ old('cardholder_name', $paymentCard->cardholder_name ?? '') }}" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')">
                        @error('cardholder_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Expiry Date and Security Code -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                            <input type="text" name="expiry_date" id="expiry_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" required placeholder="MM/YY" maxlength="5" pattern="\d{2}/\d{2}" title="Expiry date must be in MM/YY format" value="{{ old('expiry_date', $paymentCard->expiry_date ?? '') }}">
                            @error('expiry_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="security_code" class="block text-sm font-medium text-gray-700">Security Code</label>
                            <input type="text" name="security_code" id="security_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" required maxlength="3" pattern="\d{3}" title="Security code must be 3 digits" value="{{ old('security_code', $paymentCard->security_code ?? '') }}" oninput="this.value = this.value.replace(/[^\d]/g, '')">
                            @error('security_code')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-right">
                    <button type="submit" class="inline-flex items-center justify-center rounded-md bg-lime-500 px-5 py-2.5 text-sm font-bold text-white hover:bg-lime-600">
                        {{ isset($paymentCard) ? 'Update Card' : 'Add Card' }}
                    </button>
                </div>
            </form>

            <!-- Existing Cards -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Your Cards</h3>
                @if($cards->isEmpty())
                    <p class="text-gray-500">You have no saved cards.</p>
                @else
                    @foreach($cards as $card)
                        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">**** **** **** {{ substr($card->card_number, -4) }}</h3>
                                    <p class="text-sm text-gray-500">{{ $card->cardholder_name }}</p>
                                    <p class="text-sm text-gray-500">Expiry: {{ $card->expiry_date }}</p>
                                </div>
                                <div class="flex space-x-4">
                                    <a href="{{ route('payment-cards.edit', $card) }}" class="action-button bg-lime-500 text-white hover:bg-lime-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('payment-cards.destroy', $card) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this card?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-button bg-red-500 text-white hover:bg-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const expiryDateInput = document.getElementById('expiry_date');
        expiryDateInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            if (value.length > 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });
    });
</script>

<style>
    .action-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
</style>