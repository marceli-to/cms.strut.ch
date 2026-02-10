<x-layout.guest>
	<div class="min-h-full flex">

		{{-- Left: Brand panel --}}
		<div class="hidden lg:flex lg:w-1/2 bg-neutral-900 relative overflow-hidden items-end p-16">
			<div class="relative z-10">
				<div class="text-neutral-500 text-xs tracking-[0.2em] uppercase mb-3">Content Management</div>
				<div class="text-white text-4xl font-light tracking-tight leading-tight">
					{{ config('app.name', 'CMS') }}
				</div>
			</div>
			{{-- Subtle grid pattern --}}
			<div class="absolute inset-0 opacity-[0.03]"
				style="background-image: linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px); background-size: 60px 60px;">
			</div>
		</div>

		{{-- Right: Login form --}}
		<div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
			<div class="w-full max-w-sm">

				{{-- Mobile brand --}}
				<div class="lg:hidden mb-16">
					<div class="text-neutral-400 text-xs tracking-[0.2em] uppercase mb-2">Content Management</div>
					<div class="text-neutral-900 text-2xl font-light tracking-tight">{{ config('app.name', 'CMS') }}</div>
				</div>

				<h1 class="text-lg font-medium text-neutral-900 mb-1">Anmelden</h1>
				<p class="text-sm text-neutral-500 mb-10">Melden Sie sich mit Ihrem Konto an.</p>

				@if (session('status'))
					<div class="mb-6 p-3 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200">
						{{ session('status') }}
					</div>
				@endif

				<form method="POST" action="{{ route('login') }}" class="space-y-6">
					@csrf

					<div>
						<x-form.label for="email">E-Mail</x-form.label>
						<x-form.input
							type="email"
							name="email"
							:value="old('email')"
							required
							autofocus
							autocomplete="username"
						/>
						<x-form.error name="email" />
					</div>

					<div>
						<x-form.label for="password">Passwort</x-form.label>
						<x-form.input
							type="password"
							name="password"
							required
							autocomplete="current-password"
						/>
						<x-form.error name="password" />
					</div>

					<div class="flex items-center justify-between pt-2">
						<x-form.checkbox name="remember">Angemeldet bleiben</x-form.checkbox>

						@if (Route::has('password.request'))
							<x-form.link :href="route('password.request')">Passwort vergessen?</x-form.link>
						@endif
					</div>

					<div class="pt-4">
						<x-form.button class="w-full">Anmelden</x-form.button>
					</div>
				</form>

			</div>
		</div>

	</div>
</x-layout.guest>
