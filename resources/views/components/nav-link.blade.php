@props(['active'])

@php
    $linkClasses = $active ? 'block rounded-lg bg-gray-100 text-green-600' : '';
    $svgClasses = $active ? 'text-green-600' : 'text-gray-500';
@endphp

<a {{ $attributes->merge(['class' => $linkClasses]) }}>
    <div class="items-center p-2 hover:bg-gray-100 flex rounded-lg">
        <svg class="w-5 h-5 transition duration-75 group-hover:text-gray-900 {{ $svgClasses }}" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
            {!! $slot !!}
        </svg>
    </div>
</a>
