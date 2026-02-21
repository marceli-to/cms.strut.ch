<script setup>
import { computed } from 'vue'
import { PhTrash } from '@phosphor-icons/vue'
import GridSlot from './GridSlot.vue'

const props = defineProps({
	grid: { type: Object, required: true },
	layoutConfig: { type: Object, default: null },
})

const emit = defineEmits(['delete', 'add-media', 'remove-media'])

function getItemAtPosition(position) {
	return props.grid.items?.find(i => i.position === position) || null
}

const slots = computed(() => {
	const count = props.layoutConfig?.slots || 2
	return Array.from({ length: count }, (_, i) => i)
})
</script>

<template>
	<div class="border border-neutral-200 bg-white p-16">
		<!-- Header -->
		<div class="flex items-center justify-between mb-12">
			<span class="text-xxs font-medium uppercase tracking-[0.08em] text-neutral-500">
				{{ layoutConfig?.label || grid.layout_key }}
			</span>
			<button
				type="button"
				class="text-neutral-400 hover:text-red-600 transition-colors cursor-pointer"
				title="Zeile löschen"
				@click="emit('delete', grid)"
			>
				<PhTrash :size="14" />
			</button>
		</div>

		<!-- Grid layout -->
		<div :class="'grid-layout grid-layout--' + grid.layout_key">
			<GridSlot
				v-for="position in slots"
				:key="position"
				:item="getItemAtPosition(position)"
				:position="position"
				:class="'grid-slot--' + position"
				@add="emit('add-media', { gridId: grid.id, position: $event })"
				@remove="emit('remove-media', { gridId: grid.id, item: $event })"
			/>
		</div>
	</div>
</template>
