@section('meta_title', 'Wohnüberbauung Hagmannareal, Winterthur')
@section('meta_description', '')
@php
$slides = [
  ['src' => 'images/dummy-project-1.jpg'],
  ['src' => 'images/dummy-project-2.jpg'],
  ['src' => 'images/dummy-project-3.jpg'],
  ['src' => 'images/dummy-project-4.jpg'],
  ['src' => 'images/dummy-project-5.jpg'],
];

$projectInfo = [
  ['label' => 'Auftraggeberin', 'value' => 'Fa. Bateg GmbH (GÜ) für die HOWOGE'],
  ['label' => 'Entwurf und Generalplanung LP 1-8', 'value' => 'ZOOMARCHITEKTEN'],
  ['label' => 'Projekt', 'value' => 'Muster'],
  ['label' => 'Umsetzung', 'value' => '2025'],
  ['label' => 'Budget', 'value' => '2.5 Mio.'],
  ['label' => 'Auszeichnungen', 'value' => 'Architekturpreise 2025, Gute Bauten 2025 (1. Platz)'],
  ['label' => 'Anzahl Wohnungen', 'value' => '63 teilweise geförderte wohnungen'],
];

@endphp

<x-layout.show title="Wohnüberbauung Hagmannareal" location="Winterthur">

  <x-media.slideshow class="mb-20 lg:mb-40">

    <x-slot:info>
      <x-work.info
        :items="$projectInfo"
        header="weberbrunner pischetsrieder architektur, Berlin"
      />
    </x-slot:info>

    @foreach($slides as $slide)
      <div class="swiper-slide !w-auto flex justify-center items-center">
        <x-media.image
          :src="$slide['src']"
          alt=""
          class="h-(--slideshow-item-height) md:h-(--slideshow-item-height-md) lg:h-(--slideshow-item-height-lg) w-auto"
        />
      </div>
    @endforeach

  </x-media.slideshow>

  <x-work.description>
    <p>lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </x-work.description>

  <x-work.section title="Grundrisse" />
  <x-media.slideshow class="mb-40 lg:mb-80">
    <x-slot:info>
      &nbsp;
    </x-slot:info>
    @foreach($slides as $slide)
      <div class="swiper-slide !w-auto flex justify-center items-center">
        <x-media.image
          :src="$slide['src']"
          alt=""
          class="h-(--slideshow-item-height) md:h-(--slideshow-item-height-md) lg:h-(--slideshow-item-height-lg) w-auto"
        />
      </div>
    @endforeach
  </x-media.slideshow>

  <x-work.section title="Links" class="mb-40 lg:mb-80">
    <x-container.inner class="max-w-prose hyphens-auto">
      <div class="flex flex-col gap-y-6 md:gap-y-8 lg:gap-y-12">
        <x-links.cta href="#" target="_blank" label="AW20 Architekturpreis Region Winterthur">
          AW20 Architekturpreis Region Winterthur
        </x-links.cta>
        <x-links.cta href="#" target="_blank" label="Architekturpreis Kanton Zürich Auszeichnung 19">
          Architekturpreis Kanton Zürich Auszeichnung 19
        </x-links.cta>
        <x-links.cta href="#" target="_blank" label="werk, bauen+wohnen 10-2018, Dorfbau">
          werk, bauen+wohnen 10-2018, Dorfbau
        </x-links.cta>
        <x-links.cta href="#" target="_blank" label="best architect 19, gold award">
          best architect 19, gold award
        </x-links.cta>
        <x-links.cta href="#" target="_blank" label="BauNetz">
          BauNetz
        </x-links.cta>
      </div>
    </x-container.inner>
  </x-work.section>

  <x-work.section title="Team">
    <x-container.inner class="max-w-prose leading-[1.6] md:leading-[1.35]">
      <span><a href="mailto:test@wbp.ch" class="underline underline-offset-4 md:underline-offset-6 decoration-1 hover:no-underline">Boris Brunner</a>,</span> <span><a href="mailto:test@wbp.ch" class="underline underline-offset-4 md:underline-offset-6 decoration-1 hover:no-underline">Eva Geering</a>,</span>
      <span><a href="mailto:test@wbp.ch" class="underline underline-offset-4 md:underline-offset-6 decoration-1 hover:no-underline">Fabian Friedli</a>,</span> <span><a href="mailto:test@wbp.ch" class="underline underline-offset-4 md:underline-offset-6 decoration-1 hover:no-underline">Iris Bergamaschi</a>,</span>
      <span><a href="mailto:test@wbp.ch" class="underline underline-offset-4 md:underline-offset-6 decoration-1 hover:no-underline">René Breuer</a>,</span> <span><a href="mailto:test@wbp.ch" class="underline underline-offset-4 md:underline-offset-6 decoration-1 hover:no-underline">Tamas Ozvald</a>,</span>
      <span><a href="mailto:test@wbp.ch" class="underline underline-offset-4 md:underline-offset-6 decoration-1 hover:no-underline">Roger Weber</a></span>
    </x-container.inner>
  </x-work.section>

</x-layout.show>
