@props([
  'class' => null,
])
<div
  x-cloak
  x-show="menu"
  @click.outside="menu = false"
  x-transition:enter="transition ease-out duration-100"
  x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100"
  x-transition:leave="transition ease-in duration-0"
  x-transition:leave-start="opacity-100"
  x-transition:leave-end="opacity-0"
  class="{{ $class ?? ''}}">

  <nav class="h-[inherit] flex flex-col justify-between">
    
    <ul>
      <x-menu.item url="{{ route('page.works') }}" title="Arbeiten" />
      <x-menu.item url="{{ route('page.about') }}" title="Büro" />
    </ul>

    <a 
      href="{{ route('page.landing') }}" 
      title="Startseite"
      class="w-36 h-auto md:hidden">
      <x-icons.logo.symbol class="w-full h-auto" />
    </a>
  </nav>
</div>
