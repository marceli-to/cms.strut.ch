<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useBookStore } from '@/stores/books'
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
const store = useBookStore()
const toast = useToast()

const isEdit = computed(() => !!route.params.id)

const form = ref({
	title: '',
	description: '',
	info: '',
	url: '',
	publish: true,
})

onMounted(async () => {
	if (isEdit.value) {
		await store.fetchBook(route.params.id)
		if (store.current) {
			const b = store.current
			form.value = {
				title: b.title || '',
				description: b.description || '',
				info: b.info || '',
				url: b.url || '',
				publish: b.publish,
			}
		}
	}
})

async function handleSubmit() {
	const success = await store.saveBook(form.value, isEdit.value ? route.params.id : null)

	if (success) {
		toast.success(isEdit.value ? 'Buch aktualisiert' : 'Buch erstellt')
		router.push({ name: 'books.index' })
	} else if (Object.keys(store.errors).length) {
		toast.error('Bitte überprüfen Sie das Formular')
	}
}
</script>

<template>
	<div>
		<PageHeader :title="isEdit ? 'Buch bearbeiten' : 'Neues Buch'">
			<FormButton variant="secondary" @click="router.push({ name: 'books.index' })">
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
						<FormLabel>Beschreibung</FormLabel>
						<div class="mt-8">
							<Editor v-model="form.description" />
						</div>
						<FormError :message="store.errors.description" />
					</FormGroup>

					<FormGroup>
						<FormLabel>Info</FormLabel>
						<div class="mt-8">
							<Editor v-model="form.info" />
						</div>
						<FormError :message="store.errors.info" />
					</FormGroup>

					<FormGroup>
						<FormLabel for="url">URL</FormLabel>
						<FormInput id="url" v-model="form.url" />
						<FormError :message="store.errors.url" />
					</FormGroup>
				</div>

				<template #sidebar>
					<div class="flex flex-col gap-14">
						<FormCheckbox v-model="form.publish">Veröffentlichen</FormCheckbox>
					</div>
				</template>
			</FormWithSidebar>
		</form>
	</div>
</template>
