<script setup>
import { computed } from 'vue'
import draggable from 'vuedraggable'
import { PhX, PhPencil, PhStar } from '@phosphor-icons/vue'

const props = defineProps({
	items: { type: Array, default: () => [] },
})

const emit = defineEmits(['edit', 'delete', 'reorder', 'teaser'])

const dragItems = computed({
	get: () => props.items,
	set: (value) => emit('reorder', value),
})
</script>

<template>
	<draggable
		v-model="dragItems"
		item-key="uuid"
		class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-8"
		ghost-class="opacity-30"
		animation="150"
	>
		<template #item="{ element }">
			<div class="relative group cursor-grab active:cursor-grabbing">
				<div class="border border-neutral-200 overflow-hidden p-4 bg-white" :class="{ '!border-neutral-900': element.is_teaser }">
					<img
						:src="element.thumbnail_url"
						:alt="element.alt || ''"
						class="block w-full aspect-square object-cover"
					/>
				</div>
				<!-- Overlay -->
				<div class="absolute inset-0 bg-black/25 opacity-0 group-hover:opacity-100 transition-opacity duration-150 flex items-center justify-center gap-6">
					<button
						type="button"
						class="size-28 flex items-center justify-center bg-white text-neutral-900 hover:bg-neutral-100 transition-colors"
						title="Bearbeiten"
						@click.stop="emit('edit', element)"
					>
						<PhPencil :size="13" weight="bold" />
					</button>
					<button
						type="button"
						class="size-28 flex items-center justify-center bg-white text-neutral-900 hover:bg-neutral-100 transition-colors"
						title="Als Teaser setzen"
						@click.stop="emit('teaser', element)"
					>
						<PhStar :size="13" :weight="element.is_teaser ? 'fill' : 'bold'" />
					</button>
					<button
						type="button"
						class="size-28 flex items-center justify-center bg-white text-red-500 hover:bg-red-50 transition-colors"
						title="Löschen"
						@click.stop="emit('delete', element)"
					>
						<PhX :size="13" weight="bold" />
					</button>
				</div>
				<!-- Teaser badge -->
				<div
					v-if="element.is_teaser"
					class="absolute top-0 left-0 bg-neutral-900 text-white text-[9px] font-medium tracking-wide uppercase px-6 py-3 leading-none"
				>
					Teaser
				</div>
			</div>
		</template>
	</draggable>
</template>
