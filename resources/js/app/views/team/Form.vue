<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useTeamStore } from '@/stores/team'
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
const store = useTeamStore()
const toast = useToast()

const isEdit = computed(() => !!route.params.id)

const form = ref({
	name: '',
	firstname: '',
	role: '',
	position: '',
	phone: '',
	email: '',
	cv: '',
	publish: true,
})

onMounted(async () => {
	if (isEdit.value) {
		await store.fetchMember(route.params.id)
		if (store.current) {
			const m = store.current
			form.value = {
				name: m.name || '',
				firstname: m.firstname || '',
				role: m.role || '',
				position: m.position || '',
				phone: m.phone || '',
				email: m.email || '',
				cv: m.cv || '',
				publish: m.publish,
			}
		}
	}
})

async function handleSubmit() {
	const success = await store.saveMember(form.value, isEdit.value ? route.params.id : null)

	if (success) {
		toast.success(isEdit.value ? 'Mitglied aktualisiert' : 'Mitglied erstellt')
		router.push({ name: 'team.index' })
	} else if (Object.keys(store.errors).length) {
		toast.error('Bitte überprüfen Sie das Formular')
	}
}
</script>

<template>
	<div>
		<PageHeader :title="isEdit ? 'Mitglied bearbeiten' : 'Neues Mitglied'">
			<FormButton variant="secondary" @click="router.push({ name: 'team.index' })">
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
					<div class="grid grid-cols-2 gap-24">
						<FormGroup>
							<FormLabel for="firstname">Vorname *</FormLabel>
							<FormInput id="firstname" v-model="form.firstname" />
							<FormError :message="store.errors.firstname" />
						</FormGroup>
						<FormGroup>
							<FormLabel for="name">Name *</FormLabel>
							<FormInput id="name" v-model="form.name" />
							<FormError :message="store.errors.name" />
						</FormGroup>
					</div>

					<div class="grid grid-cols-2 gap-24">
						<FormGroup>
							<FormLabel for="role">Rolle</FormLabel>
							<FormInput id="role" v-model="form.role" />
							<FormError :message="store.errors.role" />
						</FormGroup>
						<FormGroup>
							<FormLabel for="position">Position</FormLabel>
							<FormInput id="position" v-model="form.position" />
							<FormError :message="store.errors.position" />
						</FormGroup>
					</div>

					<div class="grid grid-cols-2 gap-24">
						<FormGroup>
							<FormLabel for="phone">Telefon</FormLabel>
							<FormInput id="phone" v-model="form.phone" />
							<FormError :message="store.errors.phone" />
						</FormGroup>
						<FormGroup>
							<FormLabel for="email">E-Mail *</FormLabel>
							<FormInput id="email" v-model="form.email" />
							<FormError :message="store.errors.email" />
						</FormGroup>
					</div>

					<FormGroup>
						<FormLabel>CV</FormLabel>
						<div class="mt-8">
							<Editor v-model="form.cv" />
						</div>
						<FormError :message="store.errors.cv" />
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
