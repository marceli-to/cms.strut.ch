<script setup>
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useProjectStore } from '@/stores/projects'
import { useToast } from '@/composables/useToast'
import { useConfirm } from '@/composables/useConfirm'
import { PhPencil, PhTrash } from '@phosphor-icons/vue'
import FormButton from '@/components/ui/form/FormButton.vue'
import PageHeader from '@/components/layout/PageHeader.vue'
import DataTable from '@/components/ui/table/DataTable.vue'

const router = useRouter()
const store = useProjectStore()
const toast = useToast()
const { confirm } = useConfirm()

const columns = [
	{ key: 'title', label: 'Titel', class: 'px-4', primary: true },
	{ key: 'name', label: 'Name' },
	{ key: 'location', label: 'Ort' },
	{ key: 'year', label: 'Jahr', class: 'w-80' },
	{ key: 'status', label: 'Status', class: 'w-120' },
	{ key: 'actions', label: '', class: 'px-4 w-80', align: 'right' },
]

onMounted(() => {
	store.fetchProjects()
})

async function handleDelete(project) {
	const ok = await confirm({
		title: 'Projekt löschen',
		message: `"${project.title}" wirklich löschen? Dies kann nicht rückgängig gemacht werden.`,
		confirmLabel: 'Löschen',
		destructive: true,
	})
	if (!ok) return
	await store.deleteProject(project.id)
	toast.success('Projekt gelöscht')
}
</script>

<template>
	<div>
		<PageHeader title="Projekte">
			<FormButton @click="router.push({ name: 'projects.create' })">
				Neues Projekt
			</FormButton>
		</PageHeader>

		<div v-if="store.loading" class="text-sm text-neutral-400">
			Laden...
		</div>

		<div v-else-if="store.projects.length === 0" class="text-sm text-neutral-400">
			Noch keine Projekte vorhanden.
		</div>

		<DataTable v-else :columns="columns" :rows="store.projects">
			<template #cell-actions="{ row }">
				<div class="flex items-center justify-end gap-8">
					<button
						class="text-neutral-400 hover:text-neutral-900 transition-colors cursor-pointer"
						@click="router.push({ name: 'projects.edit', params: { id: row.id } })"
					>
						<PhPencil :size="16" weight="light" />
					</button>
					<button
						class="text-neutral-400 hover:text-red-600 transition-colors cursor-pointer"
						@click="handleDelete(row)"
					>
						<PhTrash :size="16" weight="light" />
					</button>
				</div>
			</template>
		</DataTable>
	</div>
</template>
