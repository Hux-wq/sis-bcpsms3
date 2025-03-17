@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link active'
            : 'nav-link';
@endphp


<li class="nav-item">
    <a {{ $attributes->merge(['class' => $classes]) }} href="index.html">
       <span> {{ $slot }}</span>
    </a>
</li>
