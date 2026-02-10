@props(['for' => null])

<label
	@if($for) for="{{ $for }}" @endif
	{{ $attributes->merge(['class' => 'block text-xs font-medium tracking-wide uppercase text-neutral-500']) }}
>
	{{ $slot }}
</label>
