@props([
    'active' => false, // determines if the button is pressed
])

<button
    {{ $attributes->merge([
        'class' => 'p-2 rounded-2xl transition ' .
            ($active
                ? 'bg-[#84cc16] text-white'
                : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900')
    ]) }}
>
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
         width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
              d="M5 7h14M5 12h14M5 17h14"/>
    </svg>
</button>
