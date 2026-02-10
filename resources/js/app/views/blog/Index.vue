<script setup>
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useBlogStore } from '../../stores/blog'
import { useToast } from '../../composables/useToast'
import FormButton from '../../components/ui/form/FormButton.vue'

const router = useRouter()
const store = useBlogStore()
const toast = useToast()

onMounted(() => {
	store.fetchPosts()
})

async function handleDelete(post) {
	if (!confirm(`"${post.title}" löschen?`)) return
	await store.deletePost(post.id)
	toast.success('Beitrag gelöscht')
}
</script>

<template>
	<div>
		<div class="flex items-center justify-between mb-36">
			<h1 class="text-lg font-medium text-neutral-900">Blog</h1>
			<FormButton @click="router.push({ name: 'blog.create' })">
				Neuer Beitrag
			</FormButton>
		</div>

		<div v-if="store.loading" class="text-sm text-neutral-400">
			Laden...
		</div>

		<div v-else-if="store.posts.length === 0" class="text-sm text-neutral-400">
			Noch keine Beiträge vorhanden.
		</div>

		<table v-else class="w-full text-sm">
			<thead>
				<tr class="text-left border-b border-neutral-200">
					<th class="py-12 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em]">Titel</th>
					<th class="py-12 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em] w-100">Status</th>
					<th class="py-12 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em] w-140">Erstellt</th>
					<th class="py-12 font-medium text-neutral-500 text-xs uppercase tracking-[0.1em] w-200 text-right">Aktionen</th>
				</tr>
			</thead>
			<tbody>
				<tr
					v-for="(post, index) in store.posts"
					:key="post.id"
					class="transition-colors hover:bg-neutral-100"
					:class="index % 2 === 0 ? 'bg-white' : 'bg-neutral-50'"
				>
					<td class="py-12 text-neutral-900">{{ post.title }}</td>
					<td class="py-12">
						<span
							class="text-xs"
							:class="post.publish ? 'text-emerald-600' : 'text-neutral-400'"
						>
							{{ post.publish ? 'Publiziert' : 'Entwurf' }}
						</span>
					</td>
					<td class="py-12 text-neutral-400 text-xs">
						{{ new Date(post.created_at).toLocaleDateString('de-CH') }}
					</td>
					<td class="py-12 text-right whitespace-nowrap">
						<button
							class="text-xs text-neutral-500 hover:text-neutral-900 underline decoration-neutral-300 underline-offset-4 hover:decoration-neutral-900 transition-colors mr-16 cursor-pointer"
							@click="router.push({ name: 'blog.edit', params: { id: post.id } })"
						>
							Bearbeiten
						</button>
						<button
							class="text-xs text-red-500 hover:text-red-700 underline decoration-red-300 underline-offset-4 hover:decoration-red-700 transition-colors cursor-pointer"
							@click="handleDelete(post)"
						>
							Löschen
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
