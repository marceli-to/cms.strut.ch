<script setup>
const model = defineModel()

defineProps({
	type: { type: String, default: 'text' },
	placeholder: { type: String, default: null },
	id: { type: String, default: null },
})
</script>

<template>
	<input
		:id="id"
		:type="type"
		:placeholder="placeholder"
		v-model="model"
		class="block w-full px-0 py-12 text-sm bg-transparent border-0 border-b border-neutral-300 text-neutral-900 placeholder:text-neutral-400 focus:border-neutral-900 focus:ring-0 transition-colors duration-200 outline-none"
	/>
</template>
