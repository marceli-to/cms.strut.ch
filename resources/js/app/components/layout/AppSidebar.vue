<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { PhBuildings, PhImage, PhSignOut, PhSquaresFour } from '@phosphor-icons/vue'

const route = useRoute()

const navigation = [
	{ name: 'Dashboard', to: '/dashboard', icon: PhSquaresFour, exact: true },
	{ name: 'Projekte', to: '/dashboard/projects', icon: PhBuildings },
	{ name: 'Media', to: '/dashboard/media', icon: PhImage },
]

function isActive(item) {
	if (item.exact) return route.path === item.to
	return route.path.startsWith(item.to)
}

function logout() {
	const token = document.querySelector('meta[name="csrf-token"]')?.content
	fetch('/logout', {
		method: 'POST',
		headers: {
			'X-CSRF-TOKEN': token,
			'Content-Type': 'application/json',
		},
	}).then(() => {
		window.location.href = '/login'
	})
}
</script>

<template>
	<aside class="fixed top-0 left-0 bottom-0 w-240 bg-neutral-900 flex flex-col z-30">

		<!-- Brand -->
		<div class="px-24 pt-32 pb-24">
			<div class="text-neutral-500 text-xxs tracking-[0.2em] uppercase mb-4">CMS</div>
			<div class="text-white text-lg font-light tracking-tight">strut.ch</div>
		</div>

		<!-- Navigation -->
		<nav class="flex-1 px-12 mt-16">
			<ul class="space-y-12">
				<li v-for="item in navigation" :key="item.to">
					<router-link
						:to="item.to"
						class="flex items-center gap-12 px-12 py-10 text-sm transition-colors duration-150"
						:class="isActive(item)
							? 'bg-white/10 text-white'
							: 'text-neutral-400 hover:text-white hover:bg-white/5'"
					>
						<component :is="item.icon" :size="18" weight="regular" />
						<span>{{ item.name }}</span>
					</router-link>
				</li>
			</ul>
		</nav>

		<!-- Logout -->
		<div class="px-12 pb-24">
			<button
				@click="logout"
				class="flex items-center gap-8 px-12 py-10 w-full text-xs text-neutral-500 hover:text-white hover:bg-white/5 transition-colors duration-150 cursor-pointer"
			>
				<PhSignOut :size="18" weight="regular" />
				<span>Abmelden</span>
			</button>
		</div>

	</aside>
</template>
