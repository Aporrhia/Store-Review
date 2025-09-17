@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="bg-white rounded-lg shadow border border-gray-200 p-8">
        <h2 class="text-3xl font-bold text-[#141414] mb-6">{{ strtoupper(substr($user->name ?? $user->email ?? 'U', 0, 1)) }}***'s Profile</h2>
        
        <h3 class="text-2xl font-bold text-[#141414] mb-4">Comments Received</h3>
        @include('store-page.components.comment-block', [
            'profileUser' => $user,
            'comments' => $comments,
            'listingUsers' => [],
            'showForm' => true
        ])
    </div>
</div>
@endsection
