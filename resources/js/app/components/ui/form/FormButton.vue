<script setup>
defineProps({
	type: { type: String, default: 'button' },
	variant: { type: String, default: 'primary' },
})
</script>

<template>
	<button
		:type="type"
		class="inline-flex items-center justify-center font-medium tracking-wide text-sm transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-neutral-900 cursor-pointer"
		:class="{
			'px-20 py-10 bg-neutral-900 text-white border border-neutral-900 hover:bg-neutral-800 hover:border-neutral-800 active:bg-neutral-950 active:border-neutral-950': variant === 'primary',
			'px-20 py-10 bg-transparent text-neutral-900 border border-neutral-300 hover:border-neutral-900 active:bg-neutral-100': variant === 'secondary',
		}"
	>
		<slot />
	</button>
</template>
