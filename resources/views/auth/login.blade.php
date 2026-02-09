<x-layout.guest>
	@if (session('status'))
		<div>
			{{ session('status') }}
		</div>
	@endif

	<form method="POST" action="{{ route('login') }}">
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
				autocomplete="username"
			/>
			@foreach ($errors->get('email') as $message)
				<p>{{ $message }}</p>
			@endforeach
		</div>

		<div>
			<label for="password">Passwort</label>
			<input
				id="password"
				type="password"
				name="password"
				required
				autocomplete="current-password"
			/>
			@foreach ($errors->get('password') as $message)
				<p>{{ $message }}</p>
			@endforeach
		</div>

		<div>
			<input
				id="remember_me"
				type="checkbox"
				name="remember"
			/>
			<label for="remember_me">Angemeldet bleiben</label>
		</div>

		<div>
			@if (Route::has('password.request'))
				<a href="{{ route('password.request') }}">
					Passwort vergessen?
				</a>
			@endif

			<button type="submit">
				Anmelden
			</button>
		</div>
	</form>
</x-layout.guest>
