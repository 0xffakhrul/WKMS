@props(['active'])

@php
    $classes = $active ?? false ? 'flex rounded-lg bg-gray-100' : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
