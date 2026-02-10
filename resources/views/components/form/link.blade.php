@props(['href'])

<a
	href="{{ $href }}"
	{{ $attributes->merge(['class' => 'text-sm text-neutral-500 hover:text-neutral-900 transition-colors duration-200 underline decoration-neutral-300 underline-offset-4 hover:decoration-neutral-900']) }}
>
	{{ $slot }}
</a>
