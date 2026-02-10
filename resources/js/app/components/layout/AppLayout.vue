<script setup>
import AppSidebar from '@/components/layout/AppSidebar.vue'
import ToastContainer from '@/components/ui/toast/Container.vue'
</script>

<template>
	<div class="min-h-screen bg-neutral-50">
		<AppSidebar />
		<div class="ml-240">
			<main class="pt-24 px-32 pb-32 relative">
				<ToastContainer />
				<slot />
			</main>
		</div>
	</div>
</template>
