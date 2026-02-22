<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useAwardStore } from '@/stores/awards'
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
const store = useAwardStore()
const toast = useToast()

const isEdit = computed(() => !!route.params.id)

const currentYear = new Date().getFullYear()
const yearOptions = Array.from(
	{ length: currentYear - 1989 },
	(_, i) => ({ value: String(currentYear - i), label: String(currentYear - i) })
)

const form = ref({
	title: '',
	description: '',
	year: String(currentYear),
	url: '',
	publish: true,
})

onMounted(async () => {
	if (isEdit.value) {
		await store.fetchAward(route.params.id)
		if (store.current) {
			const a = store.current
			form.value = {
				title: a.title || '',
				description: a.description || '',
				year: a.year || String(currentYear),
				url: a.url || '',
				publish: a.publish,
			}
		}
	}
})

async function handleSubmit() {
	const success = await store.saveAward(form.value, isEdit.value ? route.params.id : null)

	if (success) {
		toast.success(isEdit.value ? 'Auszeichnung aktualisiert' : 'Auszeichnung erstellt')
		router.push({ name: 'awards.index' })
	} else if (Object.keys(store.errors).length) {
		toast.error('Bitte überprüfen Sie das Formular')
	}
}
</script>

<template>
	<div>
		<PageHeader :title="isEdit ? 'Auszeichnung bearbeiten' : 'Neue Auszeichnung'">
			<FormButton variant="secondary" @click="router.push({ name: 'awards.index' })">
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
