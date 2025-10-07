@extends('profile.layout')

@section('profile-content')
<section class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Edit Profile</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('POST')
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" required maxlength="100">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" required maxlength="100">
            </div>
        </div>
        @if ($errors->any())
            <div class="mt-4 text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif
        <div class="mt-8 text-right">
            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-lime-500 px-5 py-2.5 text-sm font-bold text-white hover:bg-lime-600">
                Save Changes
            </button>
        </div>
    </form>
</section>
@endsection