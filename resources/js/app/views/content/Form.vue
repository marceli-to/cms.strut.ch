<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useContentStore } from '@/stores/content'
import { useToast } from '@/composables/useToast'
import Editor from '@/components/ui/editor/Editor.vue'
import FormWithSidebar from '@/components/layout/FormWithSidebar.vue'
import PageHeader from '@/components/layout/PageHeader.vue'
import FormLabel from '@/components/ui/form/FormLabel.vue'
import FormInput from '@/components/ui/form/FormInput.vue'
import FormCheckbox from '@/components/ui/form/FormCheckbox.vue'
import FormButton from '@/components/ui/form/FormButton.vue'
import FormError from '@/components/ui/form/FormError.vue'
import FormGroup from '@/components/ui/form/FormGroup.vue'

const route = useRoute()
const router = useRouter()
const store = useContentStore()
const toast = useToast()

const isEdit = computed(() => !!route.params.id)

const form = ref({
	key: '',
	title: '',
	text: '',
	publish: true,
	has_media: false,
})

onMounted(async () => {
	if (isEdit.value) {
		await store.fetchItem(route.params.id)
		if (store.current) {
			const c = store.current
			form.value = {
				key: c.key || '',
				title: c.title || '',
				text: c.text || '',
				publish: c.publish,
				has_media: c.has_media,
			}
		}
	}
})

async function handleSubmit() {
	const success = await store.saveItem(form.value, isEdit.value ? route.params.id : null)

	if (success) {
		toast.success(isEdit.value ? 'Inhalt aktualisiert' : 'Inhalt erstellt')
		router.push({ name: 'content.index' })
	} else if (Object.keys(store.errors).length) {
		toast.error('Bitte überprüfen Sie das Formular')
	}
}
</script>

<template>
	<div>
		<PageHeader :title="isEdit ? 'Inhalt bearbeiten' : 'Neuer Inhalt'">
			<FormButton variant="secondary" @click="router.push({ name: 'content.index' })">
				Abbrechen
			</FormButton>
			<FormButton @click="handleSubmit">
				{{ isEdit ? 'Aktualisieren' : 'Erstellen' }}
			</FormButton>
		</PageHeader>

		<div v-if="store.loading" class="text-sm text-neutral-400">
			Laden...
		</div>

		<form v-else @submit.prevent="handleSubmit">
			<FormWithSidebar>
				<div>
					<FormGroup>
						<FormLabel for="title">Titel *</FormLabel>
						<FormInput id="title" v-model="form.title" />
						<FormError :message="store.errors.title" />
					</FormGroup>

					<FormGroup>
						<FormLabel>Text</FormLabel>
						<div class="mt-8">
							<Editor v-model="form.text" />
						</div>
						<FormError :message="store.errors.text" />
					</FormGroup>
				</div>

				<template #sidebar>
					<FormGroup>
						<FormLabel for="key">Key *</FormLabel>
						<FormInput id="key" v-model="form.key" />
						<FormError :message="store.errors.key" />
					</FormGroup>

					<div class="flex flex-col gap-14">
						<FormCheckbox v-model="form.has_media">Hat Medien</FormCheckbox>
						<FormCheckbox v-model="form.publish">Veröffentlichen</FormCheckbox>
					</div>
				</template>
			</FormWithSidebar>
		</form>
	</div>
</template>
