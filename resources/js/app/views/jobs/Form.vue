<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useJobStore } from '@/stores/jobs'
import { useToast } from '@/composables/useToast'
import Editor from '@/components/ui/editor/Editor.vue'
import FormWithSidebar from '@/components/layout/FormWithSidebar.vue'
import PageHeader from '@/components/layout/PageHeader.vue'
import FormLabel from '@/components/ui/form/FormLabel.vue'
import FormCheckbox from '@/components/ui/form/FormCheckbox.vue'
import FormButton from '@/components/ui/form/FormButton.vue'
import FormError from '@/components/ui/form/FormError.vue'
import FormGroup from '@/components/ui/form/FormGroup.vue'
import FormInput from '@/components/ui/form/FormInput.vue'

const route = useRoute()
const router = useRouter()
const store = useJobStore()
const toast = useToast()

const isEdit = computed(() => !!route.params.id)

const form = ref({
	title: '',
	lead: '',
	info: '',
	publish: true,
})

onMounted(async () => {
	if (isEdit.value) {
		await store.fetchJob(route.params.id)
		if (store.current) {
			const j = store.current
			form.value = {
				title: j.title || '',
				lead: j.lead || '',
				info: j.info || '',
				publish: j.publish,
			}
		}
	}
})

async function handleSubmit() {
	const success = await store.saveJob(form.value, isEdit.value ? route.params.id : null)

	if (success) {
		toast.success(isEdit.value ? 'Stelle aktualisiert' : 'Stelle erstellt')
		router.push({ name: 'jobs.index' })
	} else if (Object.keys(store.errors).length) {
		toast.error('Bitte überprüfen Sie das Formular')
	}
}
</script>

<template>
	<div>
		<PageHeader :title="isEdit ? 'Stelle bearbeiten' : 'Neue Stelle'">
			<FormButton variant="secondary" @click="router.push({ name: 'jobs.index' })">
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
						<FormLabel>Lead</FormLabel>
						<div class="mt-8">
							<Editor v-model="form.lead" />
						</div>
						<FormError :message="store.errors.lead" />
					</FormGroup>

					<FormGroup>
						<FormLabel>Info</FormLabel>
						<div class="mt-8">
							<Editor v-model="form.info" />
						</div>
						<FormError :message="store.errors.info" />
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
