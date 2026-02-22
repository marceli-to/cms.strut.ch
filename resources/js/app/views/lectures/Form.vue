<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useLectureStore } from '@/stores/lectures'
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
const store = useLectureStore()
const toast = useToast()

const isEdit = computed(() => !!route.params.id)

const currentYear = new Date().getFullYear()

const form = ref({
	title: '',
	description: '',
	year: String(currentYear),
	url: '',
	publish: true,
})

onMounted(async () => {
	if (isEdit.value) {
		await store.fetchLecture(route.params.id)
		if (store.current) {
			const l = store.current
			form.value = {
				title: l.title || '',
				description: l.description || '',
				year: l.year || String(currentYear),
				url: l.url || '',
				publish: l.publish,
			}
		}
	}
})

async function handleSubmit() {
	const success = await store.saveLecture(form.value, isEdit.value ? route.params.id : null)

	if (success) {
		toast.success(isEdit.value ? 'Vortrag aktualisiert' : 'Vortrag erstellt')
		router.push({ name: 'lectures.index' })
	} else if (Object.keys(store.errors).length) {
		toast.error('Bitte überprüfen Sie das Formular')
	}
}
</script>

<template>
	<div>
		<PageHeader :title="isEdit ? 'Vortrag bearbeiten' : 'Neuer Vortrag'">
			<FormButton variant="secondary" @click="router.push({ name: 'lectures.index' })">
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
						<FormLabel for="url">URL</FormLabel>
						<FormInput id="url" v-model="form.url" />
						<FormError :message="store.errors.url" />
					</FormGroup>
				</div>

				<template #sidebar>
					<FormGroup>
						<FormLabel for="year">Jahr *</FormLabel>
						<FormInput id="year" v-model="form.year" />
						<FormError :message="store.errors.year" />
					</FormGroup>

					<div class="flex flex-col gap-14">
						<FormCheckbox v-model="form.publish">Veröffentlichen</FormCheckbox>
					</div>
				</template>
			</FormWithSidebar>
		</form>
	</div>
</template>
