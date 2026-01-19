@props([
  'items' => [],
  'header' => null,
])

<div class="text-xxs md:text-xxs lg:text-xs divide-y border-b w-full *:py-3 flex flex-col justify-end h-(--slideshow-item-height) md:h-(--slideshow-item-height-md) lg:h-(--slideshow-item-height-lg)">
  @if($header)
    <div><strong>{{ $header }}</strong></div>
  @endif
  @foreach($items as $item)
    <div><strong>{{ $item['label'] }}:</strong> {{ $item['value'] }}</div>
  @endforeach
</div>
