<script setup>
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useProjectStore } from '../../stores/projects'
import { useToast } from '../../composables/useToast'
import { useConfirm } from '../../composables/useConfirm'
import FormButton from '../../components/ui/form/FormButton.vue'
import PageHeader from '../../components/layout/PageHeader.vue'

const router = useRouter()
const store = useProjectStore()
const toast = useToast()
const { confirm } = useConfirm()

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

		<table v-else class="w-full text-sm">
			<thead>
				<tr class="text-left border-b border-neutral-200">
					<th class="py-12 px-4 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em]">Titel</th>
					<th class="py-12 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em]">Name</th>
					<th class="py-12 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em]">Ort</th>
					<th class="py-12 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em] w-80">Jahr</th>
					<th class="py-12 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em] w-120">Status</th>
					<th class="py-12 px-4 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em] w-200 text-right">Aktionen</th>
				</tr>
			</thead>
			<tbody>
				<tr
					v-for="(project, index) in store.projects"
					:key="project.id"
					class="transition-colors hover:bg-neutral-100"
					:class="index % 2 === 0 ? 'bg-white' : 'bg-neutral-50'"
				>
					<td class="py-12 px-4 text-neutral-900">{{ project.title }}</td>
					<td class="py-12 text-neutral-500 text-sm">{{ project.name }}</td>
					<td class="py-12 text-neutral-500 text-sm">{{ project.location }}</td>
					<td class="py-12 text-neutral-500 text-sm">{{ project.year }}</td>
					<td class="py-12 text-neutral-500 text-sm">{{ project.status || '–' }}</td>
					<td class="py-12 px-4 text-right whitespace-nowrap">
						<button
							class="text-xs text-neutral-500 hover:text-neutral-900 underline decoration-neutral-300 underline-offset-4 hover:decoration-neutral-900 transition-colors mr-16 cursor-pointer"
							@click="router.push({ name: 'projects.edit', params: { id: project.id } })"
						>
							Bearbeiten
						</button>
						<button
							class="text-xs text-red-500 hover:text-red-700 underline decoration-red-300 underline-offset-4 hover:decoration-red-700 transition-colors cursor-pointer"
							@click="handleDelete(project)"
						>
							Löschen
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
