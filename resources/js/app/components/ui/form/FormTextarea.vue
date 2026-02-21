<script setup>
const model = defineModel()

defineProps({
	placeholder: { type: String, default: null },
	id: { type: String, default: null },
	rows: { type: [String, Number], default: 3 },
})
</script>

<template>
	<textarea
		:id="id"
		:rows="rows"
		:placeholder="placeholder"
		v-model="model"
		class="block w-full px-0 py-12 text-sm bg-transparent border-0 border-b border-neutral-300 text-neutral-900 placeholder:text-neutral-400 focus:border-neutral-900 focus:ring-0 transition-colors duration-200 outline-none resize-none"
	/>
</template>
