<script setup>
defineProps({
	for: { type: String, default: null },
})
</script>

<template>
	<label
		:for="$props.for"
		class="block text-xxs font-medium uppercase tracking-[0.08em] text-neutral-500 -mb-1"
	>
		<slot />
	</label>
</template>
