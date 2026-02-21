<script setup>
import { PhPlus, PhX } from '@phosphor-icons/vue'

const props = defineProps({
	item: { type: Object, default: null },
	position: { type: Number, required: true },
})

const emit = defineEmits(['add', 'remove'])

const hasMedia = () => props.item?.media
</script>

<template>
	<div class="relative group border border-neutral-200 bg-neutral-50 overflow-hidden min-h-[80px]">
		<!-- Filled slot -->
		<template v-if="hasMedia()">
			<img
				:src="item.media.thumbnail_url"
				:alt="item.media.alt || ''"
				class="block w-full h-full object-cover"
			/>
			<!-- Remove overlay -->
			<div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-150 flex items-center justify-center">
				<button
					type="button"
					class="text-white/80 hover:text-white transition-colors cursor-pointer"
					title="Entfernen"
					@click="emit('remove', item)"
				>
					<PhX :size="20" />
				</button>
			</div>
		</template>

		<!-- Empty slot -->
		<template v-else>
			<button
				type="button"
				class="w-full h-full flex items-center justify-center text-neutral-400 hover:text-neutral-600 hover:bg-neutral-100 transition-colors cursor-pointer min-h-[80px]"
				@click="emit('add', position)"
			>
				<PhPlus :size="20" />
			</button>
		</template>
	</div>
</template>
