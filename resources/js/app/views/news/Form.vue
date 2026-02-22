<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useNewsStore } from '@/stores/news'
import { useToast } from '@/composables/useToast'
import Editor from '@/components/ui/editor/Editor.vue'
import FormWithSidebar from '@/components/layout/FormWithSidebar.vue'
import PageHeader from '@/components/layout/PageHeader.vue'
import FormLabel from '@/components/ui/form/FormLabel.vue'
import FormInput from '@/components/ui/form/FormInput.vue'
import FormButton from '@/components/ui/form/FormButton.vue'
import FormError from '@/components/ui/form/FormError.vue'
import FormGroup from '@/components/ui/form/FormGroup.vue'

const route = useRoute()
const router = useRouter()
const store = useNewsStore()
const toast = useToast()

const isEdit = computed(() => !!route.params.id)

const form = ref({
	title: '',
	subtitle: '',
	date: '',
	text: '',
	link: '',
	link_text: '',
})

onMounted(async () => {
	if (isEdit.value) {
		await store.fetchNewsItem(route.params.id)
		if (store.current) {
			const n = store.current
			form.value = {
				title: n.title || '',
				subtitle: n.subtitle || '',
				date: n.date || '',
				text: n.text || '',
				link: n.link || '',
				link_text: n.link_text || '',
			}
		}
	}
})

async function handleSubmit() {
	const success = await store.saveNews(form.value, isEdit.value ? route.params.id : null)

	if (success) {
		toast.success(isEdit.value ? 'News aktualisiert' : 'News erstellt')
		router.push({ name: 'news.index' })
	} else if (Object.keys(store.errors).length) {
		toast.error('Bitte überprüfen Sie das Formular')
	}
}
</script>

<template>
	<div>
		<PageHeader :title="isEdit ? 'News bearbeiten' : 'Neue News'">
			<FormButton variant="secondary" @click="router.push({ name: 'news.index' })">
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
						<FormLabel for="subtitle">Untertitel</FormLabel>
						<FormInput id="subtitle" v-model="form.subtitle" />
						<FormError :message="store.errors.subtitle" />
					</FormGroup>

					<FormGroup>
						<FormLabel>Text</FormLabel>
						<div class="mt-8">
							<Editor v-model="form.text" />
						</div>
						<FormError :message="store.errors.text" />
					</FormGroup>

					<div class="grid grid-cols-2 gap-24">
						<FormGroup>
							<FormLabel for="link">Link</FormLabel>
							<FormInput id="link" v-model="form.link" />
							<FormError :message="store.errors.link" />
						</FormGroup>
						<FormGroup>
							<FormLabel for="link_text">Link Text</FormLabel>
							<FormInput id="link_text" v-model="form.link_text" />
							<FormError :message="store.errors.link_text" />
						</FormGroup>
					</div>
				</div>

				<template #sidebar>
					<FormGroup>
						<FormLabel for="date">Datum</FormLabel>
						<FormInput id="date" v-model="form.date" />
						<FormError :message="store.errors.date" />
					</FormGroup>
				</template>
			</FormWithSidebar>
		</form>
	</div>
</template>
