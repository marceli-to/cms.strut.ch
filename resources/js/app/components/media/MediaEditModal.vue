<script setup>
import { ref, watch } from 'vue'
import Drawer from '@/components/ui/drawer/Drawer.vue'

const props = defineProps({
	media: { type: Object, default: null },
})

const emit = defineEmits(['close', 'save'])

const isOpen = ref(false)

const form = ref({
	alt: '',
	caption: '',
})

watch(() => props.media, (val) => {
	if (val) {
		form.value.alt = val.alt || ''
		form.value.caption = val.caption || ''
		isOpen.value = true
	} else {
		isOpen.value = false
	}
}, { immediate: true })

function close() {
	isOpen.value = false
	emit('close')
}

function handleSave() {
	emit('save', {
		uuid: props.media.uuid,
		data: { ...form.value },
	})
	isOpen.value = false
}
</script>

<template>
	<Drawer
		:open="isOpen"
		:title="media?.type === 'video' ? 'Video bearbeiten' : 'Bild bearbeiten'"
		@close="close"
	>
		<!-- Preview -->
		<div class="bg-neutral-50 border-b border-neutral-200">
			<video
				v-if="media?.type === 'video'"
				:src="media.original_url"
				class="w-full max-h-[320px] object-contain"
				controls
				muted
				preload="metadata"
			/>
			<img
				v-else-if="media"
				:src="media.preview_url"
				:alt="media.alt || ''"
				class="w-full max-h-[320px] object-contain"
			/>
		</div>

		<!-- File info -->
		<div v-if="media" class="px-24 py-16 border-b border-neutral-100 text-xs text-neutral-400 space-y-2">
			<div class="text-neutral-900 font-medium">{{ media.original_name }}</div>
			<div>
				<template v-if="media.width && media.height">{{ media.width }} &times; {{ media.height }} px · </template>
				{{ media.mime_type }}
			</div>
		</div>

		<!-- Fields -->
		<div class="px-24 py-20 space-y-16">
			<div>
				<label class="block text-xs font-medium text-neutral-500 uppercase mb-6">Alt-Text</label>
				<input
					v-model="form.alt"
					type="text"
					class="w-full border border-neutral-200 px-12 py-10 text-sm text-neutral-900 focus:outline-none focus:border-neutral-900 transition-colors"
					placeholder="Bildbeschreibung für Screenreader..."
				/>
			</div>

			<div>
				<label class="block text-xs font-medium text-neutral-500 uppercase mb-6">Bildunterschrift</label>
				<textarea
					v-model="form.caption"
					rows="3"
					class="w-full border border-neutral-200 px-12 py-10 text-sm text-neutral-900 focus:outline-none focus:border-neutral-900 transition-colors resize-none"
					placeholder="Optionale Bildunterschrift..."
				/>
			</div>
		</div>

		<!-- Footer -->
		<template #footer>
			<div class="flex gap-12">
				<button
					type="button"
					class="flex-1 bg-neutral-900 text-white text-sm font-medium py-10 hover:bg-neutral-800 active:bg-neutral-950 transition-colors"
					@click="handleSave"
				>
					Speichern
				</button>
				<button
					type="button"
					class="px-16 py-10 border border-neutral-200 text-sm text-neutral-500 hover:text-neutral-900 hover:border-neutral-400 transition-colors"
					@click="close"
				>
					Abbrechen
				</button>
			</div>
		</template>
	</Drawer>
</template>
