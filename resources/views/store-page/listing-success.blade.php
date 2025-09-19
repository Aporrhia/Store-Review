@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-16">
    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
        <!-- Success Icon -->
        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
            <span class="material-symbols-outlined text-3xl text-green-600">check_circle</span>
        </div>
        
        <!-- Success Message -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Listing Submitted Successfully!</h1>
        <p class="text-lg text-gray-600 mb-8">
            Your listing has been submitted and is currently under review by our administrators. 
            You will be notified once it has been approved and made visible to other users.
        </p>
        
        <!-- Info Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
            <div class="flex items-start">
                <span class="material-symbols-outlined text-blue-600 mt-1 mr-3">info</span>
                <div class="text-left">
                    <h3 class="font-semibold text-blue-800 mb-1">What happens next?</h3>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Our team will review your listing for quality and appropriateness</li>
                        <li>• This process typically takes 24-48 hours</li>
                        <li>• You'll receive an email notification once approved</li>
                        <li>• Your listing will then be visible to all users</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('listing.create') }}" 
               class="bg-lime-500 hover:bg-lime-400 text-white font-bold py-3 px-6 rounded-lg text-lg transition">
                Create Another Listing
            </a>
            <a href="{{ route('home') }}" 
               class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-3 px-6 rounded-lg text-lg transition">
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection