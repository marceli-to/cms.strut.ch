<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useBlogStore } from '../../stores/blog'
import { useMediaStore } from '../../stores/media'
import { useToast } from '../../composables/useToast'
import MediaUploader from '../../components/media/MediaUploader.vue'
import MediaGrid from '../../components/media/MediaGrid.vue'
import MediaEditModal from '../../components/media/MediaEditModal.vue'
import Editor from '../../components/ui/editor/Editor.vue'
import FormLabel from '../../components/ui/form/FormLabel.vue'
import FormInput from '../../components/ui/form/FormInput.vue'
import FormCheckbox from '../../components/ui/form/FormCheckbox.vue'
import FormButton from '../../components/ui/form/FormButton.vue'
import FormError from '../../components/ui/form/FormError.vue'
import FormGroup from '../../components/ui/form/FormGroup.vue'

const route = useRoute()
const router = useRouter()
const store = useBlogStore()
const mediaStore = useMediaStore()
const toast = useToast()

const isEdit = computed(() => !!route.params.id)
const editingMedia = ref(null)

const form = ref({
	title: '',
	content: '',
	publish: false,
})

onMounted(async () => {
	mediaStore.setItems([])
	if (isEdit.value) {
		await store.fetchPost(route.params.id)
		if (store.current) {
			form.value.title = store.current.title
			form.value.content = store.current.content || ''
			form.value.publish = store.current.publish
			mediaStore.setItems(store.current.media || [])
		}
	}
})

async function handleSubmit() {
	const tempMedia = mediaStore.tempItems.map(item => ({
		uuid: item.uuid,
		file: item.file,
		original_name: item.original_name,
		mime_type: item.mime_type,
		size: item.size,
		width: item.width,
		height: item.height,
		alt: item.alt || null,
		caption: item.caption || null,
	}))

	const success = await store.savePost(form.value, isEdit.value ? route.params.id : null, tempMedia)
	if (success) {
		toast.success(isEdit.value ? 'Beitrag aktualisiert' : 'Beitrag erstellt')
		router.push({ name: 'blog.index' })
	} else if (Object.keys(store.errors).length) {
		toast.error('Bitte überprüfen Sie das Formular')
	}
}

function onUploaded(media) {
	mediaStore.addItem(media)
}

function onEditMedia(media) {
	editingMedia.value = media
}

async function onSaveMedia({ uuid, data }) {
	const success = await mediaStore.updateItem(uuid, data)
	if (success) {
		editingMedia.value = null
	}
}

async function onDeleteMedia(media) {
	await mediaStore.deleteItem(media.uuid)
}

function onReorderMedia(items) {
	mediaStore.reorder(items)
}

function onSetTeaser(media) {
	mediaStore.setTeaser(media.uuid)
}
</script>

<template>
	<div class="max-w-4xl">

		<div class="flex items-center justify-between mb-36">
			<h1 class="text-lg font-medium text-neutral-900">
				{{ isEdit ? 'Beitrag bearbeiten' : 'Neuer Beitrag' }}
			</h1>
		</div>

		<div v-if="store.loading" class="text-sm text-neutral-400">
			Laden...
		</div>

		<form v-else @submit.prevent="handleSubmit">

			<FormGroup>
				<FormLabel for="title">Titel</FormLabel>
				<FormInput id="title" v-model="form.title" />
				<FormError :message="store.errors.title" />
			</FormGroup>

			<FormGroup>
				<FormLabel>Inhalt</FormLabel>
				<div class="mt-8">
					<Editor v-model="form.content" />
				</div>
				<FormError :message="store.errors.content" />
			</FormGroup>

			<FormGroup>
				<FormCheckbox v-model="form.publish">Veröffentlichen</FormCheckbox>
			</FormGroup>

			<FormGroup>
				<FormLabel>Bilder</FormLabel>
				<div class="mt-12">
					<MediaGrid
						v-if="mediaStore.items.length"
						:items="mediaStore.items"
						class="mb-16"
						@edit="onEditMedia"
						@delete="onDeleteMedia"
						@reorder="onReorderMedia"
						@teaser="onSetTeaser"
					/>
					<MediaUploader @uploaded="onUploaded" />
				</div>
			</FormGroup>

			<div class="flex gap-12 pt-16">
				<FormButton type="submit">
					{{ isEdit ? 'Aktualisieren' : 'Erstellen' }}
				</FormButton>
				<FormButton variant="secondary" @click="router.push({ name: 'blog.index' })">
					Abbrechen
				</FormButton>
			</div>

		</form>

		<MediaEditModal
			:media="editingMedia"
			@close="editingMedia = null"
			@save="onSaveMedia"
		/>

	</div>
</template>
