<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import Uppy from '@uppy/core'
import DragDrop from '@uppy/drag-drop'
import StatusBar from '@uppy/status-bar'
import XHRUpload from '@uppy/xhr-upload'
import German from '@uppy/locales/lib/de_DE'

import '@uppy/core/css/style.min.css'
import '@uppy/drag-drop/css/style.min.css'
import '@uppy/status-bar/css/style.min.css'

const emit = defineEmits(['uploaded'])

const dragDropRef = ref(null)
const statusBarRef = ref(null)
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

	uppy.use(DragDrop, {
		target: dragDropRef.value,
	})

	uppy.use(StatusBar, {
		target: statusBarRef.value,
		hideUploadButton: true,
		hideAfterFinish: false,
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

	uppy.on('upload-success', (file, response) => {
		emit('uploaded', response.body.data)
		uppy.removeFile(file.id)
	})
})

onBeforeUnmount(() => {
	if (uppy) {
		uppy.destroy()
	}
})
</script>

<template>
	<div class="media-uploader">
		<div ref="dragDropRef"></div>
		<div ref="statusBarRef"></div>
	</div>
</template>
