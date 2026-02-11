<script setup>
import { ref, onMounted, computed } from 'vue'
import { useToast } from '../../composables/useToast'
import { useConfirm } from '../../composables/useConfirm'
import mediaApi from '../../api/media'
import MediaUploader from '../../components/media/MediaUploader.vue'
import MediaEditModal from '../../components/media/MediaEditModal.vue'
import { PhTrash, PhPencil, PhMagnifyingGlass } from '@phosphor-icons/vue'
import PageHeader from '../../components/layout/PageHeader.vue'

const toast = useToast()
const { confirm } = useConfirm()

const items = ref([])
const loading = ref(true)
const editingMedia = ref(null)
const search = ref('')

const filteredItems = computed(() => {
	if (!search.value.trim()) return items.value
	const q = search.value.toLowerCase()
	return items.value.filter(item =>
		(item.original_name || '').toLowerCase().includes(q) ||
		(item.alt || '').toLowerCase().includes(q) ||
		(item.caption || '').toLowerCase().includes(q)
	)
})

onMounted(async () => {
	await fetchMedia()
})

async function fetchMedia() {
	loading.value = true
	try {
		const { data } = await mediaApi.index()
		items.value = data.data
	} finally {
		loading.value = false
	}
}

function onUploaded(mediaData) {
	items.value.unshift(mediaData)
	toast.success('Bild hochgeladen')
}

function openEdit(media) {
	editingMedia.value = media
}

async function handleSave({ uuid, data }) {
	try {
		const { data: response } = await mediaApi.update(uuid, data)
		const index = items.value.findIndex(i => i.uuid === uuid)
		if (index !== -1) {
			items.value[index] = response.data
		}
		editingMedia.value = null
		toast.success('Gespeichert')
	} catch {
		toast.error('Fehler beim Speichern')
	}
}

async function handleDelete(media) {
	const ok = await confirm({
		title: 'Bild löschen',
		message: `"${media.original_name}" wirklich löschen? Dies kann nicht rückgängig gemacht werden.`,
		confirmLabel: 'Löschen',
		destructive: true,
	})
	if (!ok) return
	try {
		await mediaApi.destroy(media.uuid)
		items.value = items.value.filter(i => i.uuid !== media.uuid)
		toast.success('Bild gelöscht')
	} catch {
		toast.error('Fehler beim Löschen')
	}
}

function formatSize(bytes) {
	if (!bytes) return '–'
	if (bytes < 1024) return bytes + ' B'
	if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB'
	return (bytes / (1024 * 1024)).toFixed(1) + ' MB'
}
</script>

<template>
	<div>
		<PageHeader title="Media">
			<span v-if="!loading" class="text-sm text-neutral-400">
				{{ items.length }} {{ items.length === 1 ? 'Datei' : 'Dateien' }}
			</span>
		</PageHeader>

		<!-- Upload -->
		<div class="mb-24">
			<MediaUploader compact @uploaded="onUploaded" />
		</div>

		<!-- Search -->
		<div class="relative mb-24" v-if="items.length > 0">
			<PhMagnifyingGlass :size="14" class="absolute left-12 top-1/2 -translate-y-1/2 text-neutral-400" />
			<input
				v-model="search"
				type="text"
				placeholder="Suchen..."
				class="w-full border border-neutral-200 pl-32 pr-12 py-10 text-sm text-neutral-900 focus:outline-none focus:border-neutral-400 bg-white"
			/>
		</div>

		<!-- Loading -->
		<div v-if="loading" class="text-sm text-neutral-400">
			Laden...
		</div>

		<!-- Empty -->
		<div v-else-if="items.length === 0" class="text-sm text-neutral-400">
			Noch keine Medien vorhanden.
		</div>

		<!-- Grid -->
		<div v-else-if="filteredItems.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
			<div
				v-for="media in filteredItems"
				:key="media.uuid"
				class="group relative bg-white border border-neutral-200 overflow-hidden hover:border-neutral-400 transition-colors"
			>
				<!-- Image -->
				<div class="aspect-square overflow-hidden">
					<img
						:src="media.thumbnail_url"
						:alt="media.alt || media.original_name"
						class="w-full h-full object-cover"
					/>
				</div>

				<!-- Info -->
				<div class="px-10 py-8 border-t border-neutral-100">
					<div class="text-xs text-neutral-900 truncate">{{ media.original_name }}</div>
					<div class="text-[10px] text-neutral-400 mt-2">
						{{ media.width }}&times;{{ media.height }} · {{ formatSize(media.size) }}
					</div>
					<div v-if="media.alt" class="text-[10px] text-neutral-500 truncate mt-2">
						Alt: {{ media.alt }}
					</div>
				</div>

				<!-- In-use badge -->
				<div
					v-if="media.in_use"
					class="absolute top-0 left-0 bg-neutral-900 text-white text-[9px] font-medium tracking-wide uppercase px-6 py-3 leading-none"
				>
					Verwendet
				</div>

				<!-- Overlay actions -->
				<div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-150 flex items-center justify-center gap-8">
					<button
						type="button"
						class="size-32 flex items-center justify-center bg-white text-neutral-900 hover:bg-neutral-100 transition-colors"
						title="Bearbeiten"
						@click="openEdit(media)"
					>
						<PhPencil :size="14" weight="bold" />
					</button>
					<button
						v-if="!media.in_use"
						type="button"
						class="size-32 flex items-center justify-center bg-white text-red-500 hover:bg-red-50 transition-colors"
						title="Löschen"
						@click="handleDelete(media)"
					>
						<PhTrash :size="14" weight="bold" />
					</button>
				</div>
			</div>
		</div>

		<!-- No search results -->
		<div v-else class="text-sm text-neutral-400">
			Keine Ergebnisse für "{{ search }}".
		</div>

		<!-- Edit Modal -->
		<MediaEditModal
			:media="editingMedia"
			@close="editingMedia = null"
			@save="handleSave"
		/>
	</div>
</template>
