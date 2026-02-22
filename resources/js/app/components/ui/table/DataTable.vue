<script setup>
import draggable from 'vuedraggable'

const props = defineProps({
	columns: { type: Array, required: true },
	rows: { type: Array, required: true },
	draggableRows: { type: Boolean, default: false },
})

const model = defineModel()
</script>

<template>
	<div>
		<table class="w-full text-sm">
			<thead>
				<tr class="text-left border-b border-neutral-200">
					<th
						v-for="col in columns"
						:key="col.key"
						class="py-12 text-xxs font-medium uppercase tracking-[0.08em] text-neutral-500"
						:class="[
							col.class || '',
							col.align === 'right' ? 'text-right' : '',
						]"
					>
						{{ col.label }}
					</th>
				</tr>
			</thead>
			<draggable
				v-if="draggableRows"
				v-model="model"
				tag="tbody"
				item-key="id"
				ghost-class="opacity-30"
				animation="150"
			>
				<template #item="{ element: row, index }">
					<tr
						class="transition-colors hover:bg-neutral-100 cursor-move"
						:class="index % 2 === 0 ? 'bg-white' : 'bg-neutral-50'"
					>
						<td
							v-for="col in columns"
							:key="col.key"
							class="py-12 first:pl-4 last:pr-4"
							:class="[
								col.class || '',
								col.align === 'right' ? 'text-right' : '',
								col.primary ? 'text-neutral-900' : 'text-neutral-500 text-sm',
							]"
						>
							<slot :name="'cell-' + col.key" :row="row" :value="row[col.key]">
								{{ row[col.key] ?? '–' }}
							</slot>
						</td>
					</tr>
				</template>
			</draggable>
			<tbody v-else>
				<tr
					v-for="(row, index) in rows"
					:key="row.id ?? index"
					class="transition-colors hover:bg-neutral-100"
					:class="index % 2 === 0 ? 'bg-white' : 'bg-neutral-50'"
				>
					<td
						v-for="col in columns"
						:key="col.key"
						class="py-12 first:pl-4 last:pr-4"
						:class="[
							col.class || '',
							col.align === 'right' ? 'text-right' : '',
							col.primary ? 'text-neutral-900' : 'text-neutral-500 text-sm',
						]"
					>
						<slot :name="'cell-' + col.key" :row="row" :value="row[col.key]">
							{{ row[col.key] ?? '–' }}
						</slot>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
