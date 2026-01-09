@props([
  'title' => null,
])
<x-layout.partials.head :title="$title" />

<x-layout.partials.body>

  <x-layout.partials.header class="px-20 lg:px-40 py-20 lg:py-40 min-h-dvh md:min-h-auto flex flex-col md:flex-row justify-between relative">
    <div class="flex justify-between md:items-start md:order-2">
      <div class="flex flex-col md:flex-row md:items-start gap-y-30 md:gap-y-0 md:gap-x-30">
        <x-icons.logo.wa class="w-full h-auto max-w-200 xs:max-w-248 lg:max-w-280 grow-0" />
        <x-icons.logo.wpa class="w-full h-auto max-w-200 xs:max-w-248 lg:max-w-280 grow-0" />
      </div>
      <div class="md:hidden">
        <x-menu.buttons.show class="w-32 h-auto mt-7" />
      </div>
    </div>
    <div class="md:order-1 flex justify-center">
      <x-icons.logo.symbol class="w-full h-auto max-w-280 lg:max-w-300 xl:max-w-440" />
    </div>

    <x-menu.wrapper class="bg-white px-20 py-20 w-full h-full max-h-dvh fixed top-0 bottom-0 z-30 md:!block md:absolute md:bg-red-50 md:-bottom-80 lg:-bottom-120 md:h-auto md:w-auto md:top-auto md:left-20 lg:left-40 md:px-0 md:py-0" />
    <x-menu.buttons.hide class="w-24 h-auto fixed top-27 right-25 z-50 md:hidden" />

    
  </x-layout.partials.header>

  <x-layout.partials.main>
    {{ $slot }}
  </x-layout.partials.main>

</x-layout.partials.body>

<x-layout.partials.footer />
