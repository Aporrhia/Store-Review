@extends('profile.layout')

@section('profile-content')
<section class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    @include('store-page.components.comment-block', [
        'profileUser' => $user,
        'comments' => $comments,
        'listingUsers' => [],
        'showForm' => true
    ])
</section>
@endsection