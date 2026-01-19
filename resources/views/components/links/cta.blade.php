@props([
  'href' => null,
  'label' => null,
  'target' => '_self',
])

<a
  href="{{ $href }}"
  @if($label) 
  aria-label="{{ $label }}"
  target="{{ $target }}"
  @endif
  {{ $attributes->merge(['class' => 'inline-flex items-center gap-x-6 group']) }}>
  →
  <span class="underline underline-offset-4 md:underline-offset-6 decoration-1 group-hover:no-underline">
  {{ $slot }}
  </span>
</a>
