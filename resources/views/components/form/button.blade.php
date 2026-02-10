@props(['type' => 'submit', 'variant' => 'primary'])

@php
$base = 'inline-flex items-center justify-center font-medium tracking-wide text-sm transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-neutral-900';
$variants = [
	'primary' => 'px-8 py-3 bg-neutral-900 text-white hover:bg-neutral-800 active:bg-neutral-950',
	'secondary' => 'px-8 py-3 bg-transparent text-neutral-900 border border-neutral-300 hover:border-neutral-900 active:bg-neutral-100',
];
@endphp

<button
	type="{{ $type }}"
	{{ $attributes->merge(['class' => $base . ' ' . ($variants[$variant] ?? $variants['primary'])]) }}
>
	{{ $slot }}
</button>
