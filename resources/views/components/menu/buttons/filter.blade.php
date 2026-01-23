@props([
  'hasActiveFilters' => false,
])

<button
  @click="filter = !filter"
  x-cloak
  {{ $attributes->merge(['class' => 'w-25 h-auto cursor-pointer']) }}>
  <x-icons.filter variant="{{ !$hasActiveFilters ? 'outline' : 'filled' }}" class="w-full h-auto" />
</button>
