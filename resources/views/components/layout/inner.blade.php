@props([
  'title' => null,
])
<x-layout.partials.head />

<x-layout.partials.body>

  <div class="md:grid md:grid-cols-12 w-full flex-1 px-20 lg:px-40">
    <nav class="hidden md:block md:col-span-2">
      [Nav]
    </nav>
    <div class="md:col-span-10">
      <x-layout.partials.header class="flex flex-col md:flex-row md:items-start md:justify-end gap-y-30 md:gap-y-0 md:gap-x-30 py-20 lg:pt-40">
        @if ($title)
          <h1 class="md:hidden font-semibold text-3xl">
            {{ $title }}
          </h1>
        @endif
        <x-icons.logo.wa class="w-full h-auto hidden md:block xs:max-w-248 lg:max-w-280 grow-0" />
        <x-icons.logo.wpa class="w-full h-auto hidden md:block xs:max-w-248 lg:max-w-280 grow-0" />
      </x-layout.partials.header>

      <x-layout.partials.main>
        {{ $slot }}
      </x-layout.partials.main>
    </div>
  </div>

</x-layout.partials.body>

<x-layout.partials.footer />
