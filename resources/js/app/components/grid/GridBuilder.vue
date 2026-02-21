<script setup>
import { ref, computed, onMounted } from 'vue'
import draggable from 'vuedraggable'
import { useGridStore } from '@/stores/grids'
import { useMediaStore } from '@/stores/media'
import GridLayoutSelector from './GridLayoutSelector.vue'
import GridRow from './GridRow.vue'
import GridMediaPicker from './GridMediaPicker.vue'

const props = defineProps({
	projectId: { type: [Number, String], required: true },
})

const gridStore = useGridStore()
const mediaStore = useMediaStore()

const pickerVisible = ref(false)
const pickerContext = ref(null)

const imageMedia = computed(() =>
	mediaStore.items.filter(i => i.type === 'image')
)

const dragGrids = computed({
	get: () => gridStore.grids,
	set: (value) => gridStore.reorderGrids(props.projectId, value),
})

function getLayoutConfig(key) {
	return gridStore.layouts.find(l => l.key === key) || null
}

onMounted(async () => {
	await gridStore.fetchLayouts(props.projectId)
	await gridStore.fetchGrids(props.projectId)
})

async function onAddGrid(layoutKey) {
	await gridStore.addGrid(props.projectId, layoutKey)
}

async function onDeleteGrid(grid) {
	await gridStore.removeGrid(props.projectId, grid.id)
}

function onAddMedia({ gridId, position }) {
	pickerContext.value = { gridId, position }
	pickerVisible.value = true
}

async function onSelectMedia(media) {
	if (!pickerContext.value) return
	const { gridId, position } = pickerContext.value
	await gridStore.assignItem(props.projectId, gridId, {
		media_id: media.id,
		position,
	})
	pickerContext.value = null
}

async function onRemoveMedia({ gridId, item }) {
	await gridStore.removeItem(props.projectId, gridId, item.id)
}

function onClosePicker() {
	pickerVisible.value = false
	pickerContext.value = null
}
</script>

<template>
	<div>
		<!-- Layout selector -->
		<div class="mb-24">
			<p class="text-xxs font-medium uppercase tracking-[0.08em] text-neutral-500 mb-12">
				Zeile hinzufügen
			</p>
			<GridLayoutSelector
				:layouts="gridStore.layouts"
				@add="onAddGrid"
			/>
		</div>

		<!-- Loading -->
		<div v-if="gridStore.loading" class="text-sm text-neutral-400">
			Laden...
		</div>

		<!-- Grid rows -->
		<draggable
			v-else-if="dragGrids.length"
			v-model="dragGrids"
			item-key="id"
			handle=".grid-drag-handle"
			ghost-class="opacity-30"
			animation="150"
			class="flex flex-col gap-16"
		>
			<template #item="{ element }">
				<div class="relative group">
					<!-- Drag handle -->
					<div class="grid-drag-handle absolute -left-28 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity cursor-grab active:cursor-grabbing text-neutral-400 hover:text-neutral-600">
						<svg width="12" height="20" viewBox="0 0 12 20" fill="currentColor">
							<circle cx="3" cy="3" r="1.5" />
							<circle cx="9" cy="3" r="1.5" />
							<circle cx="3" cy="10" r="1.5" />
							<circle cx="9" cy="10" r="1.5" />
							<circle cx="3" cy="17" r="1.5" />
							<circle cx="9" cy="17" r="1.5" />
						</svg>
					</div>

					<GridRow
						:grid="element"
						:layout-config="getLayoutConfig(element.layout_key)"
						@delete="onDeleteGrid"
						@add-media="onAddMedia"
						@remove-media="onRemoveMedia"
					/>
				</div>
			</template>
		</draggable>

		<p v-else class="text-sm text-neutral-400">
			Noch keine Zeilen vorhanden. Wählen Sie oben ein Layout.
		</p>

		<!-- Media picker modal -->
		<GridMediaPicker
			:media="imageMedia"
			:visible="pickerVisible"
			@select="onSelectMedia"
			@close="onClosePicker"
		/>
	</div>
</template>
