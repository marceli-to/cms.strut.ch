@props([
  'title' => null,
  'active' => false,
  'action' => null,
])

<li>
  <button
    wire:click="{{ $action }}"
    type="button"
    class="font-semibold text-md md:text-lg lg:text-xl flex items-center cursor-pointer group">
    @if($active)
      <span class="inline-flex items-center w-20">
        <x-icons.arrow-right size="sm" class="h-auto w-14" />
      </span>
    @endif
    <span>{{ $title }}</span>
  </button>
</li>
