@props([
  'title' => null,
  'class' => '',
])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-12 pl-20 lg:pl-40 ' . $class]) }}>

  <div class="md:col-span-9 md:col-start-4">

    @if($title)
      <x-headings.section class="mb-6 md:mb-8 lg:mb-10">
        {{ $title }}
      </x-headings.section>
    @endif

    {{ $slot }}

  </div>

</div>
