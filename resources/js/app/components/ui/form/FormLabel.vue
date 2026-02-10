<script setup>
defineProps({
	for: { type: String, default: null },
})
</script>

<template>
	<label
		:for="$props.for"
		class="block text-[10px] font-medium tracking-[0.1em] uppercase text-neutral-500 -mb-1"
	>
		<slot />
	</label>
</template>
