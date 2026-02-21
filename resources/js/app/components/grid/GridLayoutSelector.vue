<script setup>
const props = defineProps({
	layouts: { type: Array, default: () => [] },
})

const emit = defineEmits(['add'])

const layoutIcons = {
	'2fr': [
		{ x: 0, y: 0, w: 14, h: 24 },
		{ x: 16, y: 0, w: 14, h: 24 },
	],
	'1fr_stacked-1fr': [
		{ x: 0, y: 0, w: 14, h: 11 },
		{ x: 0, y: 13, w: 14, h: 11 },
		{ x: 16, y: 0, w: 14, h: 24 },
	],
	'1fr-1fr_stacked': [
		{ x: 0, y: 0, w: 14, h: 24 },
		{ x: 16, y: 0, w: 14, h: 11 },
		{ x: 16, y: 13, w: 14, h: 11 },
	],
	'1fr_sm_lg-1fr_lg_sm': [
		{ x: 0, y: 0, w: 14, h: 8 },
		{ x: 0, y: 10, w: 14, h: 14 },
		{ x: 16, y: 0, w: 14, h: 14 },
		{ x: 16, y: 16, w: 14, h: 8 },
	],
	'1fr_lg_sm-1fr_sm_lg': [
		{ x: 0, y: 0, w: 14, h: 14 },
		{ x: 0, y: 16, w: 14, h: 8 },
		{ x: 16, y: 0, w: 14, h: 8 },
		{ x: 16, y: 10, w: 14, h: 14 },
	],
	'1fr_sm_lg-1fr_lg': [
		{ x: 0, y: 0, w: 14, h: 8 },
		{ x: 0, y: 10, w: 14, h: 14 },
		{ x: 16, y: 0, w: 14, h: 24 },
	],
	'1fr_lg-1fr_sm_lg': [
		{ x: 0, y: 0, w: 14, h: 24 },
		{ x: 16, y: 0, w: 14, h: 8 },
		{ x: 16, y: 10, w: 14, h: 14 },
	],
}
</script>

<template>
	<div class="flex flex-wrap gap-8">
		<button
			v-for="layout in layouts"
			:key="layout.key"
			type="button"
			class="border border-neutral-200 p-10 hover:border-neutral-900 transition-colors cursor-pointer bg-white"
			:title="layout.label"
			@click="emit('add', layout.key)"
		>
			<svg width="30" height="24" viewBox="0 0 30 24">
				<rect
					v-for="(rect, i) in (layoutIcons[layout.key] || [])"
					:key="i"
					:x="rect.x"
					:y="rect.y"
					:width="rect.w"
					:height="rect.h"
					fill="currentColor"
					class="text-neutral-300"
				/>
			</svg>
		</button>
	</div>
</template>
