<script setup>
defineProps({
	columns: { type: Array, required: true },
	rows: { type: Array, required: true },
})
</script>

<template>
	<table class="w-full text-sm">
		<thead>
			<tr class="text-left border-b border-neutral-200">
				<th
					v-for="col in columns"
					:key="col.key"
					class="py-12 font-medium text-neutral-500 text-xs uppercase"
					:class="[
						col.class || '',
						col.align === 'right' ? 'text-right' : '',
					]"
				>
					{{ col.label }}
				</th>
			</tr>
		</thead>
		<tbody>
			<tr
				v-for="(row, index) in rows"
				:key="row.id ?? index"
				class="transition-colors hover:bg-neutral-100"
				:class="index % 2 === 0 ? 'bg-white' : 'bg-neutral-50'"
			>
				<td
					v-for="col in columns"
					:key="col.key"
					class="py-12"
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
</template>
