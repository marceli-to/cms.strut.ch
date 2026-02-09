<x-layout.guest>
	<form method="POST" action="{{ route('password.store') }}">
		@csrf

		<input type="hidden" name="token" value="{{ $request->route('token') }}">

		<div>
			<label for="email">E-Mail</label>
			<input
				id="email"
				type="email"
				name="email"
				value="{{ old('email', $request->email) }}"
				required
				autofocus
				autocomplete="username"
			/>
			@foreach ($errors->get('email') as $message)
				<p>{{ $message }}</p>
			@endforeach
		</div>

		<div>
			<label for="password">Neues Passwort</label>
			<input
				id="password"
				type="password"
				name="password"
				required
				autocomplete="new-password"
			/>
			@foreach ($errors->get('password') as $message)
				<p>{{ $message }}</p>
			@endforeach
		</div>

		<div>
			<label for="password_confirmation">Passwort bestätigen</label>
			<input
				id="password_confirmation"
				type="password"
				name="password_confirmation"
				required
				autocomplete="new-password"
			/>
			@foreach ($errors->get('password_confirmation') as $message)
				<p>{{ $message }}</p>
			@endforeach
		</div>

		<div>
			<button type="submit">
				Passwort zurücksetzen
			</button>
		</div>
	</form>
</x-layout.guest>
