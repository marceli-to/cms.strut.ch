@props([
  'title' => 'Projektbeschrieb',
])

<x-work.section :title="$title" class="mb-40 lg:mb-80">
  <x-container.inner class="max-w-prose hyphens-auto">
    {{ $slot }}
  </x-container.inner>
</x-work.section>
