<script setup>
import { computed } from 'vue'
import draggable from 'vuedraggable'
import { PhTrash, PhPencil, PhStar } from '@phosphor-icons/vue'

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
					<video
						v-if="element.type === 'video'"
						:src="element.original_url"
						class="block w-full aspect-square object-cover"
						muted
						preload="metadata"
					/>
					<img
						v-else
						:src="element.thumbnail_url"
						:alt="element.alt || ''"
						class="block w-full aspect-square object-cover"
					/>
				</div>
				<!-- Overlay -->
				<div class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-150 flex items-center justify-center gap-16">
					<button
						type="button"
						class="text-white/70 hover:text-white transition-colors cursor-pointer"
						title="Bearbeiten"
						@click.stop="emit('edit', element)"
					>
						<PhPencil :size="18" />
					</button>
					<button
						type="button"
						class="text-white/70 hover:text-white transition-colors cursor-pointer"
						title="Als Teaser setzen"
						@click.stop="emit('teaser', element)"
					>
						<PhStar :size="18" :weight="element.is_teaser ? 'fill' : 'light'" />
					</button>
					<button
						type="button"
						class="text-white/70 hover:text-white transition-colors cursor-pointer"
						title="Löschen"
						@click.stop="emit('delete', element)"
					>
						<PhTrash :size="18" weight="light" />
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
