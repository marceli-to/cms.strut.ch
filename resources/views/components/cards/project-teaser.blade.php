@props([
  'title' => null,
  'image' => null,
  'slug' => null,
  'class' => null
])
<a 
  href="{{ route('page.works.show', $slug) }}" 
  aria-label="{{ $title }}"
  class="p-20 md:pb-30 flex flex-col gap-y-15 border-b border-black {{ $class }} group">

  @if($image)
    <x-media.image :src="$image" class="group-hover:opacity-90 transition-all" />
  @endif

  <x-headings.h2 class="font-semibold text-md md:text-lg lg:text-xl leading-[1.25]">
    {{ $title }}
  </x-headings.h2>
  
</a>