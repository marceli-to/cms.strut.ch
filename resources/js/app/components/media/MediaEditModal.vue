<script setup>
import { ref, watch } from 'vue'
import { PhX } from '@phosphor-icons/vue'

const props = defineProps({
	media: { type: Object, default: null },
})

const emit = defineEmits(['close', 'save'])

const form = ref({
	alt: '',
	caption: '',
})

const visible = ref(false)

watch(() => props.media, (val) => {
	if (val) {
		form.value.alt = val.alt || ''
		form.value.caption = val.caption || ''
		// Trigger slide-in on next tick
		requestAnimationFrame(() => {
			visible.value = true
		})
	} else {
		visible.value = false
	}
}, { immediate: true })

function close() {
	visible.value = false
	setTimeout(() => emit('close'), 200)
}

function handleSave() {
	emit('save', {
		uuid: props.media.uuid,
		data: { ...form.value },
	})
	visible.value = false
	setTimeout(() => {}, 200)
}
</script>

<template>
	<Teleport to="body">
		<div v-if="media" class="fixed inset-0 z-50">
			<!-- Backdrop -->
			<Transition name="fade">
				<div
					v-if="visible"
					class="absolute inset-0 bg-black/40"
					@click="close"
				/>
			</Transition>

			<!-- Drawer -->
			<div
				class="absolute top-0 right-0 bottom-0 w-full max-w-[420px] bg-white shadow-xl transition-transform duration-200 ease-out flex flex-col"
				:class="visible ? 'translate-x-0' : 'translate-x-full'"
			>
				<!-- Header -->
				<div class="flex items-center justify-between px-24 py-20 border-b border-neutral-200">
					<h3 class="text-sm font-semibold text-neutral-900">Bild bearbeiten</h3>
					<button
						type="button"
						class="size-28 flex items-center justify-center text-neutral-400 hover:text-neutral-900 transition-colors"
						@click="close"
					>
						<PhX :size="16" weight="bold" />
					</button>
				</div>

				<!-- Content -->
				<div class="flex-1 overflow-y-auto">
					<!-- Image preview -->
					<div class="bg-neutral-50 border-b border-neutral-200">
						<img
							:src="media.preview_url"
							:alt="media.alt || ''"
							class="w-full max-h-[320px] object-contain"
						/>
					</div>

					<!-- File info -->
					<div class="px-24 py-16 border-b border-neutral-100 text-xs text-neutral-400 space-y-2">
						<div class="text-neutral-900 font-medium">{{ media.original_name }}</div>
						<div>{{ media.width }} &times; {{ media.height }} px · {{ media.mime_type }}</div>
					</div>

					<!-- Fields -->
					<div class="px-24 py-20 space-y-16">
						<div>
							<label class="block text-xs font-medium text-neutral-500 uppercase tracking-[0.1em] mb-6">Alt-Text</label>
							<input
								v-model="form.alt"
								type="text"
								class="w-full border border-neutral-200 px-12 py-10 text-sm text-neutral-900 focus:outline-none focus:border-neutral-900 transition-colors"
								placeholder="Bildbeschreibung für Screenreader..."
							/>
						</div>

						<div>
							<label class="block text-xs font-medium text-neutral-500 uppercase tracking-[0.1em] mb-6">Bildunterschrift</label>
							<textarea
								v-model="form.caption"
								rows="3"
								class="w-full border border-neutral-200 px-12 py-10 text-sm text-neutral-900 focus:outline-none focus:border-neutral-900 transition-colors resize-none"
								placeholder="Optionale Bildunterschrift..."
							/>
						</div>
					</div>
				</div>

				<!-- Footer -->
				<div class="px-24 py-16 border-t border-neutral-200 flex gap-12">
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
			</div>
		</div>
	</Teleport>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
	transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
	opacity: 0;
}
</style>
