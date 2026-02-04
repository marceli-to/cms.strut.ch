@php
  $symbol = random_int(1, 18);
@endphp

@switch($symbol)
  @case(1)
    <svg width="41" height="42" viewBox="0 0 41 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.23 19.77V0H41C40.84 10.85 32.08 19.61 21.23 19.77Z" fill="currentColor"/>
      <path d="M41 41H21.23V21.23C32.08 21.39 40.84 30.15 41 41Z" fill="currentColor"/>
      <path d="M19.77 0.0100098V19.78H0C0.16 8.93003 8.92002 0.17001 19.77 0.0100098Z" fill="currentColor"/>
      <path d="M0 41.01V21.2401H19.77C19.61 32.0901 10.85 40.85 0 41.01Z" fill="currentColor"/>
    </svg>
  @break

  @case(2)
    <svg width="41" height="42" viewBox="0 0 41 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M41 19.77H21.23V0C32.08 0.16 40.84 8.92002 41 19.77Z" fill="currentColor"/>
      <path d="M21.23 41V21.23H41C40.84 32.08 32.08 40.84 21.23 41Z" fill="currentColor"/>
      <path d="M0 19.78V0.0100098H19.77C19.61 10.86 10.85 19.62 0 19.78Z" fill="currentColor"/>
      <path d="M0 41.01V21.2401H19.77C19.61 32.0901 10.85 40.85 0 41.01Z" fill="currentColor"/>
    </svg>
  @break

  @case(3)
    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M41 0V19.77H21.23C21.39 8.92002 30.15 0.16 41 0Z" fill="currentColor"/>
      <path d="M21.23 21.22H41V40.99C30.15 40.83 21.39 32.07 21.23 21.22Z" fill="currentColor"/>
      <path d="M19.77 19.77H0V0C10.85 0.16 19.61 8.92002 19.77 19.77Z" fill="currentColor"/>
      <path d="M19.77 21.23V41H0C0.16 30.15 8.91999 21.39 19.77 21.23Z" fill="currentColor"/>
    </svg>
  @break

  @case(4)
    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.23 0H41V19.77C30.15 19.61 21.39 10.85 21.23 0Z" fill="currentColor"/>
      <path d="M21.23 40.99V21.22H41C40.84 32.07 32.08 40.83 21.23 40.99Z" fill="currentColor"/>
      <path d="M19.77 0V19.77H0C0.16 8.92002 8.91996 0.16 19.77 0Z" fill="currentColor"/>
      <path d="M0 41V21.23H19.77C19.61 32.08 10.85 40.84 0 41Z" fill="currentColor"/>
    </svg>
  @break

  @case(5)
    <svg width="41" height="42" viewBox="0 0 41 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M41 19.77H21.23V0C32.08 0.16 40.84 8.92002 41 19.77Z" fill="currentColor"/>
      <path d="M41 41H21.23V21.23C32.08 21.39 40.84 30.15 41 41Z" fill="currentColor"/>
      <path d="M0 19.78V0.0100098H19.77C19.61 10.86 10.85 19.62 0 19.78Z" fill="currentColor"/>
      <path d="M19.77 21.2401V41.01H0C0.16 30.16 8.92002 21.4001 19.77 21.2401Z" fill="currentColor"/>
    </svg>
  @break

  @case(6)
    <svg width="41" height="42" viewBox="0 0 41 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M41 19.77H21.23V0C32.08 0.16 40.84 8.92002 41 19.77Z" fill="currentColor"/>
      <path d="M21.23 41V21.23H41C40.84 32.08 32.08 40.84 21.23 41Z" fill="currentColor"/>
      <path d="M19.77 0.0100098V19.78H0C0.16 8.93003 8.91996 0.17001 19.77 0.0100098Z" fill="currentColor"/>
      <path d="M19.77 21.2401V41.01H0C0.16 30.16 8.91996 21.4001 19.77 21.2401Z" fill="currentColor"/>
    </svg>
  @break

  @case(7)
    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.24 19.77V0H41.01C40.85 10.85 32.09 19.61 21.24 19.77Z" fill="currentColor"/>
      <path d="M21.23 41V21.23H41C40.84 32.08 32.08 40.84 21.23 41Z" fill="currentColor"/>
      <path d="M0 19.78V0.0100098H19.77C19.61 10.86 10.85 19.62 0 19.78Z" fill="currentColor"/>
      <path d="M0 41.01V21.2401H19.77C19.61 32.0901 10.85 40.85 0 41.01Z" fill="currentColor"/>
    </svg>
  @break

  @case(8)
    <svg width="42" height="41" viewBox="0 0 42 41" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M41 0V19.77H21.23C21.39 8.92002 30.15 0.16 41 0Z" fill="currentColor"/>
      <path d="M21.2401 40.99V21.22H41.01C40.85 32.07 32.0901 40.83 21.2401 40.99Z" fill="currentColor"/>
      <path d="M0 0H19.77V19.77C8.92002 19.61 0.16 10.85 0 0Z" fill="currentColor"/>
      <path d="M0.0100098 21.23H19.78V41C8.93003 40.84 0.17001 32.08 0.0100098 21.23Z" fill="currentColor"/>
    </svg>
  @break

  @case(9)
    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.24 19.77V0H41.01C40.85 10.85 32.09 19.61 21.24 19.77Z" fill="currentColor"/>
      <path d="M21.24 21.23H41.01V41C30.16 40.84 21.4 32.08 21.24 21.23Z" fill="currentColor"/>
      <path d="M19.77 19.78H0V0.0100098C10.85 0.17001 19.61 8.93003 19.77 19.78Z" fill="currentColor"/>
      <path d="M0.0100098 21.2401H19.78V41.01C8.92997 40.85 0.17001 32.0901 0.0100098 21.2401Z" fill="currentColor"/>
    </svg>
  @break

  @case(10)
    <svg width="42" height="41" viewBox="0 0 42 41" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.24 0H41.01V19.77C30.16 19.61 21.4 10.85 21.24 0Z" fill="currentColor"/>
      <path d="M21.24 40.99V21.22H41.01C40.85 32.07 32.09 40.83 21.24 40.99Z" fill="currentColor"/>
      <path d="M19.77 0V19.77H0C0.16 8.92002 8.92002 0.16 19.77 0Z" fill="currentColor"/>
      <path d="M19.77 21.23V41H0C0.16 30.15 8.92002 21.39 19.77 21.23Z" fill="currentColor"/>
    </svg>
  @break

  @case(11)
    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M41 0V19.77H21.23C21.39 8.92002 30.15 0.16 41 0Z" fill="currentColor"/>
      <path d="M41 40.99H21.23V21.22C32.08 21.38 40.84 30.14 41 40.99Z" fill="currentColor"/>
      <path d="M0 0H19.77V19.77C8.92002 19.61 0.16 10.85 0 0Z" fill="currentColor"/>
      <path d="M19.77 21.23V41H0C0.16 30.15 8.92002 21.39 19.77 21.23Z" fill="currentColor"/>
    </svg>
  @break

  @case(12)
    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.24 19.77V0H41.01C40.85 10.85 32.09 19.61 21.24 19.77Z" fill="currentColor"/>
      <path d="M21.24 41V21.23H41.01C40.85 32.08 32.09 40.84 21.24 41Z" fill="currentColor"/>
      <path d="M19.77 0.0100098V19.78H0C0.16 8.93003 8.92002 0.17001 19.77 0.0100098Z" fill="currentColor"/>
      <path d="M19.78 41.01H0.0100098V21.2401C10.86 21.4001 19.62 30.16 19.78 41.01Z" fill="currentColor"/>
    </svg>
  @break

  @case(13)
    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M41.01 19.77H21.24V0C32.09 0.16 40.85 8.92002 41.01 19.77Z" fill="currentColor"/>
      <path d="M41.01 41H21.24V21.23C32.09 21.39 40.85 30.15 41.01 41Z" fill="currentColor"/>
      <path d="M19.77 0.0100098V19.78H0C0.16 8.93003 8.92002 0.17001 19.77 0.0100098Z" fill="currentColor"/>
      <path d="M0.0100098 41.01V21.2401H19.78C19.62 32.0901 10.86 40.85 0.0100098 41.01Z" fill="currentColor"/>
    </svg>
  @break

  @case(14)
    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.23 0H41V19.77C30.15 19.61 21.39 10.85 21.23 0Z" fill="currentColor"/>
      <path d="M21.23 40.99V21.22H41C40.84 32.07 32.08 40.83 21.23 40.99Z" fill="currentColor"/>
      <path d="M0 0H19.77V19.77C8.92002 19.61 0.16 10.85 0 0Z" fill="currentColor"/>
      <path d="M0 21.23H19.77V41C8.92002 40.84 0.16 32.08 0 21.23Z" fill="currentColor"/>
    </svg>
  @break

  @case(15)
    <svg width="42" height="41" viewBox="0 0 42 41" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.24 0H41.01V19.77C30.16 19.61 21.4 10.85 21.24 0Z" fill="currentColor"/>
      <path d="M21.24 40.99V21.22H41.01C40.85 32.07 32.09 40.83 21.24 40.99Z" fill="currentColor"/>
      <path d="M19.7699 19.77H0V0C10.85 0.16 19.6099 8.92002 19.7699 19.77Z" fill="currentColor"/>
      <path d="M0.0100098 41V21.23H19.7799C19.6199 32.08 10.86 40.84 0.0100098 41Z" fill="currentColor"/>
    </svg>
  @break

  @case(16)
    <svg width="41" height="42" viewBox="0 0 41 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M41 19.77H21.23V0C32.08 0.16 40.84 8.92002 41 19.77Z" fill="currentColor"/>
      <path d="M21.23 41V21.23H41C40.84 32.08 32.08 40.84 21.23 41Z" fill="currentColor"/>
      <path d="M0 19.78V0.0100098H19.77C19.61 10.86 10.85 19.62 0 19.78Z" fill="currentColor"/>
      <path d="M0 21.2401H19.77V41.01C8.92002 40.85 0.16 32.0901 0 21.2401Z" fill="currentColor"/>
    </svg>
  @break

  @case(17)
    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.24 19.77V0H41.01C40.85 10.85 32.09 19.61 21.24 19.77Z" fill="currentColor"/>
      <path d="M21.24 41V21.23H41.01C40.85 32.08 32.09 40.84 21.24 41Z" fill="currentColor"/>
      <path d="M19.77 0.0100098V19.78H0C0.16 8.93003 8.92002 0.17001 19.77 0.0100098Z" fill="currentColor"/>
      <path d="M0.0100098 41.01V21.2401H19.78C19.62 32.0901 10.86 40.85 0.0100098 41.01Z" fill="currentColor"/>
    </svg>
  @break

  @case(18)
    <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M41 0V19.77H21.23C21.39 8.92002 30.15 0.16 41 0Z" fill="currentColor"/>
      <path d="M21.23 21.22H41V40.99C30.15 40.83 21.39 32.07 21.23 21.22Z" fill="currentColor"/>
      <path d="M19.77 19.77H0V0C10.85 0.16 19.61 8.92002 19.77 19.77Z" fill="currentColor"/>
      <path d="M0 41V21.23H19.77C19.61 32.08 10.85 40.84 0 41Z" fill="currentColor"/>
    </svg>
  @break

  @default
    <svg width="41" height="42" viewBox="0 0 41 42" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => '']) }}>
      <path d="M21.23 19.77V0H41C40.84 10.85 32.08 19.61 21.23 19.77Z" fill="currentColor"/>
      <path d="M41 41H21.23V21.23C32.08 21.39 40.84 30.15 41 41Z" fill="currentColor"/>
      <path d="M19.77 0.0100098V19.78H0C0.16 8.93003 8.92002 0.17001 19.77 0.0100098Z" fill="currentColor"/>
      <path d="M0 41.01V21.2401H19.77C19.61 32.0901 10.85 40.85 0 41.01Z" fill="currentColor"/>
    </svg>
@endswitch
