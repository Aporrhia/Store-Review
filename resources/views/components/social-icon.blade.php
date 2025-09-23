@props(['icon', 'size' => 'normal', 'hover' => 'white'])

@php
    $sizes = [
        'normal' => 'h-6 w-6',
        'large' => 'h-40 w-40', // 10rem
    ];
    $iconSize = $sizes[$size] ?? $sizes['normal'];

    $hoverColors = [
        'white' => 'hover:text-white',
        'black' => 'hover:text-black',
        // add more if needed
    ];
    $hoverClass = $hoverColors[$hover] ?? $hoverColors['white'];

    $icons = [
        'instagram' => [
            'href' => 'https://www.instagram.com/tsi_university/',
            'label' => 'Instagram',
            'svg' => '<svg aria-hidden="true" class="'.$iconSize.'" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2A5.75 5.75 0 0 0 2 7.75v8.5A5.75 5.75 0 0 0 7.75 22h8.5A5.75 5.75 0 0 0 22 16.25v-8.5A5.75 5.75 0 0 0 16.25 2h-8.5zm0 1.5h8.5A4.25 4.25 0 0 1 20.5 7.75v8.5A4.25 4.25 0 0 1 16.25 20.5h-8.5A4.25 4.25 0 0 1 3.5 16.25v-8.5A4.25 4.25 0 0 1 7.75 3.5zm4.25 3.25a5.25 5.25 0 1 0 0 10.5 5.25 5.25 0 0 0 0-10.5zm0 1.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5zm5.25.75a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>',
        ],
        'youtube' => [
            'href' => 'https://www.youtube.com/TSIRiga',
            'label' => 'YouTube',
            'svg' => '<svg aria-hidden="true" class="'.$iconSize.'" fill="currentColor" viewBox="0 0 24 24"><path d="M21.8 8.001a2.75 2.75 0 0 0-1.94-1.94C18.2 6 12 6 12 6s-6.2 0-7.86.06a2.75 2.75 0 0 0-1.94 1.94A28.6 28.6 0 0 0 2 12a28.6 28.6 0 0 0 .2 3.999 2.75 2.75 0 0 0 1.94 1.94C5.8 18 12 18 12 18s6.2 0 7.86-.06a2.75 2.75 0 0 0 1.94-1.94A28.6 28.6 0 0 0 22 12a28.6 28.6 0 0 0-.2-3.999zM10 15.5v-7l6 3.5-6 3.5z"/></svg>',
        ],
        'tiktok' => [
            'href' => 'https://www.tiktok.com/@tsi_university',
            'label' => 'TikTok',
            'svg' => '<svg aria-hidden="true" class="'.$iconSize.'" fill="currentColor" viewBox="0 0 24 24"><path d="M12.75 2v13.25a2.25 2.25 0 1 1-2.25-2.25c.124 0 .246.012.366.03V10.5a5.25 5.25 0 1 0 5.25 5.25V8.25c.66.36 1.42.57 2.25.57V6.75c-.83 0-1.59-.21-2.25-.57V2h-3.366z"/></svg>',
        ],
    ];
    $data = $icons[$icon] ?? null;
@endphp

@if($data)
<a href="{{ $data['href'] }}" target="_blank" rel="noopener" class="text-gray-400 transition-colors {{ $hoverClass }}">
    <span class="sr-only">{{ $data['label'] }}</span>
    {!! $data['svg'] !!}
</a>
@endif