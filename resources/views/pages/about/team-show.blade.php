@section('meta_title', $member['firstname'] . ' ' . $member['name'] . ' – Team')
@section('meta_description', '')

<x-layout.inner
  title="{{ $member['firstname'] }} {{ $member['name'] }}"
  containerClass="!pl-0 md:!pl-20 lg:!pl-0"
  headerClass="pl-20"
  mainClass="!pb-0 relative">

  <div class="md:min-h-(--content-height-md) lg:min-h-(--content-height-lg) border-t md:border-l border-black">
    <div class="md:grid md:grid-cols-9 bg-white">

      <div class="md:col-span-3 p-20 pb-25">
        <x-media.image
          :src="$member['image']"
          :alt="$member['firstname'] . ' ' . $member['name']"
          class="w-full aspect-3/4 object-cover mx-auto"
        />
        <div class="mt-30 hidden md:block">
          <a href="{{ route('page.about.team') }}" class="text-sm font-semibold">back</a>
        </div>
      </div>

      <div class="md:col-span-6 p-20 md:p-30 md:pt-20">
        <div class="font-semibold text-xs md:text-xxs lg:text-sm flex flex-col mb-30">
          <x-headings.h2>
            {{ $member['firstname'] }} {{ $member['name'] }}
          </x-headings.h2>
          @if($member['title'])
            <span>{{ $member['title'] }}</span>
          @endif
          @if($member['since'])
            <span>Mitarbeit seit {{ $member['since'] }}</span>
          @endif
          @if($member['email'])
            <a
              href="mailto:{{ $member['email'] }}"
              class="underline underline-offset-4 md:underline-offset-6 decoration-1 hover:no-underline">
              {{ $member['email'] }}
            </a>
          @endif
        </div>

        @if(isset($member['birthplace']))
          <p class="text-xs md:text-xxs lg:text-sm mb-20">
            Geboren in {{ $member['birthplace'] }}
          </p>
        @endif

        @if(isset($member['cv']) && count($member['cv']) > 0)
          <div class="space-y-15 max-w-[65ch]">
            @foreach($member['cv'] as $entry)
              <div class="md:grid md:grid-cols-12 md:gap-x-10 text-xs md:text-xxs lg:text-sm">
                <div class="md:col-span-3 xl:col-span-2">{{ $entry['period'] }}</div>
                <div class="md:col-span-9 xl:col-span-10">{{ $entry['description'] }}</div>
              </div>
            @endforeach
          </div>
        @endif

        <div class="mt-25 md:hidden">
          <a href="{{ route('page.about.team') }}" class="text-sm font-semibold">back</a>
        </div>

      </div>

    </div>
  </div>

</x-layout.inner>
