import { defineStore } from 'pinia'
import awardsApi from '@/api/awards'

export const useAwardStore = defineStore('awards', {
	state: () => ({
		awards: {},
		current: null,
		loading: false,
		errors: {},
	}),

	actions: {
		async fetchAwards() {
			this.loading = true
			try {
				const { data } = await awardsApi.index()
				this.awards = data.data
			} finally {
				this.loading = false
			}
		},

		async fetchAward(id) {
			this.loading = true
			try {
				const { data } = await awardsApi.show(id)
				this.current = data.data
			} finally {
				this.loading = false
			}
		},

		async saveAward(form, id = null) {
			this.errors = {}
			try {
				if (id) {
					await awardsApi.update(id, form)
				} else {
					await awardsApi.store(form)
				}
				return true
			} catch (error) {
				if (error.response?.status === 422) {
					this.errors = error.response.data.errors
				}
				return false
			}
		},

		async toggle(id) {
			try {
				await awardsApi.toggle(id)
				await this.fetchAwards()
			} catch {}
		},

		async deleteAward(id) {
			await awardsApi.destroy(id)
			await this.fetchAwards()
		},
	},
})
