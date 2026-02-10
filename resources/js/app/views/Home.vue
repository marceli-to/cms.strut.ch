<script setup>
import { PhArticle, PhImage } from '@phosphor-icons/vue'
</script>

<template>
	<div>
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-16">

			<router-link
				to="/dashboard/blog"
				class="group bg-white border border-neutral-200 p-24 hover:border-neutral-400 transition-colors duration-150"
			>
				<div class="flex items-center gap-12 mb-12">
					<PhArticle :size="20" weight="regular" class="text-neutral-400 group-hover:text-neutral-900 transition-colors" />
					<h2 class="text-sm font-medium text-neutral-900">Blog</h2>
				</div>
				<p class="text-xs text-neutral-500">Beiträge erstellen und verwalten.</p>
			</router-link>

			<router-link
				to="/dashboard/media"
				class="group bg-white border border-neutral-200 p-24 hover:border-neutral-400 transition-colors duration-150"
			>
				<div class="flex items-center gap-12 mb-12">
					<PhImage :size="20" weight="regular" class="text-neutral-400 group-hover:text-neutral-900 transition-colors" />
					<h2 class="text-sm font-medium text-neutral-900">Media</h2>
				</div>
				<p class="text-xs text-neutral-500">Bilder und Dateien verwalten.</p>
			</router-link>

		</div>
	</div>
</template>
