<script setup>
import Drawer from '@/components/ui/drawer/Drawer.vue'

const props = defineProps({
	media: { type: Array, default: () => [] },
	visible: { type: Boolean, default: false },
})

const emit = defineEmits(['select', 'close'])

function selectMedia(media) {
	emit('select', media)
	emit('close')
}
</script>

<template>
	<Drawer :open="visible" title="Bild auswählen" size="md" @close="emit('close')">
		<div class="p-24">
			<div v-if="media.length" class="grid grid-cols-3 gap-8">
				<button
					v-for="item in media"
					:key="item.id"
					type="button"
					class="border border-neutral-200 overflow-hidden p-4 bg-white hover:border-neutral-900 transition-colors cursor-pointer"
					@click="selectMedia(item)"
				>
					<img
						:src="item.thumbnail_url"
						:alt="item.alt || ''"
						class="block w-full aspect-square object-cover"
					/>
				</button>
			</div>
			<p v-else class="text-sm text-neutral-400">
				Keine Bilder vorhanden. Laden Sie zuerst Bilder im «Bilder»-Tab hoch.
			</p>
		</div>
	</Drawer>
</template>
