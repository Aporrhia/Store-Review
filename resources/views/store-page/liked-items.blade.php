@extends('layouts.app')
<title>Liked Items</title>
@section('content')
<div class="relative flex size-full min-h-screen flex-col overflow-x-hidden group/design-root bg-white"
    style="font-family: 'Plus Jakarta Sans', 'Noto Sans', sans-serif;">
    <div class="relative flex size-full min-h-screen flex-col overflow-x-hidden group/design-root">
        <div class="flex h-full grow flex-col">
            <main class="flex flex-1">
                <div class="flex-1 p-8">
                    @include('store-page.components.breadcrumbs')
                    <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-[#141414]">Liked Items</h1>
                    <div class="mt-6">
                        @if($items->isEmpty())
                            <div class="text-center text-gray-500 text-lg py-12">No liked items yet.</div>
                        @else
                            @include('store-page.components.product-list-grid', ['items' => $items])
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
