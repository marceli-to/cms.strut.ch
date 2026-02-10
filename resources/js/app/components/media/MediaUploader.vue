<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { PhUploadSimple } from '@phosphor-icons/vue'
import Uppy from '@uppy/core'
import XHRUpload from '@uppy/xhr-upload'
import German from '@uppy/locales/lib/de_DE'

const emit = defineEmits(['uploaded'])

const fileInput = ref(null)
const isDragging = ref(false)
const uploading = ref(false)
const progress = ref(0)
let uppy = null

onMounted(() => {
	const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content

	uppy = new Uppy({
		locale: German,
		autoProceed: true,
		restrictions: {
			allowedFileTypes: ['.jpg', '.jpeg', '.png', '.webp', '.gif'],
			maxFileSize: 51200 * 1024,
		},
	})

	uppy.use(XHRUpload, {
		endpoint: '/api/dashboard/media/upload',
		fieldName: 'file',
		headers: {
			'X-CSRF-TOKEN': csrfToken,
			'Accept': 'application/json',
			'X-Requested-With': 'XMLHttpRequest',
		},
	})

	uppy.on('upload', () => {
		uploading.value = true
		progress.value = 0
	})

	uppy.on('progress', (value) => {
		progress.value = value
	})

	uppy.on('upload-success', (file, response) => {
		emit('uploaded', response.body.data)
		uppy.removeFile(file.id)
	})

	uppy.on('complete', () => {
		uploading.value = false
		progress.value = 0
	})
})

onBeforeUnmount(() => {
	if (uppy) uppy.destroy()
})

function onDrop(e) {
	isDragging.value = false
	const files = e.dataTransfer?.files
	if (files) addFiles(files)
}

function onFileSelect(e) {
	const files = e.target?.files
	if (files) addFiles(files)
	if (fileInput.value) fileInput.value.value = ''
}

function addFiles(fileList) {
	for (const file of fileList) {
		try {
			uppy.addFile({
				name: file.name,
				type: file.type,
				data: file,
			})
		} catch (err) {
			// duplicate or restricted
		}
	}
}
</script>

<template>
	<div>
		<div
			class="border transition-colors duration-150 cursor-pointer"
			:class="isDragging
				? 'border-neutral-900 bg-neutral-100'
				: 'border-neutral-300 hover:border-neutral-400 bg-white'"
			@click="fileInput?.click()"
			@dragover.prevent="isDragging = true"
			@dragleave.prevent="isDragging = false"
			@drop.prevent="onDrop"
		>
			<div class="flex flex-col items-center justify-center py-40 px-24">
				<PhUploadSimple :size="24" weight="regular" class="text-neutral-400 mb-12" />
				<p class="text-xs text-neutral-500">
					<span class="text-neutral-900 underline decoration-neutral-300 underline-offset-4">Dateien auswählen</span>
					oder hierhin ziehen
				</p>
				<p class="text-[10px] text-neutral-400 mt-6">JPG, PNG, WebP, GIF — max. 50 MB</p>
			</div>
		</div>

		<!-- Progress bar -->
		<div v-if="uploading" class="mt-8">
			<div class="h-2 bg-neutral-200 overflow-hidden">
				<div
					class="h-full bg-neutral-900 transition-all duration-300"
					:style="{ width: progress + '%' }"
				/>
			</div>
		</div>

		<input
			ref="fileInput"
			type="file"
			multiple
			accept=".jpg,.jpeg,.png,.webp,.gif"
			class="hidden"
			@change="onFileSelect"
		/>
	</div>
</template>
