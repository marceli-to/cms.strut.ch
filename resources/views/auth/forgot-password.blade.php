<x-layout.guest>
	<div>
		Geben Sie Ihre E-Mail-Adresse ein und wir senden Ihnen einen Link zum Zurücksetzen Ihres Passworts.
	</div>

	@if (session('status'))
		<div>
			{{ session('status') }}
		</div>
	@endif

	<form method="POST" action="{{ route('password.email') }}">
		@csrf

		<div>
			<label for="email">E-Mail</label>
			<input
				id="email"
				type="email"
				name="email"
				value="{{ old('email') }}"
				required
				autofocus
			/>
			@foreach ($errors->get('email') as $message)
				<p>{{ $message }}</p>
			@endforeach
		</div>

		<div>
			<a href="{{ route('login') }}">
				Zurück zum Login
			</a>

			<button type="submit">
				Link senden
			</button>
		</div>
	</form>
</x-layout.guest>
