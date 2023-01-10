<template>
	<div class="intro-x p-3 rounded-md border border-solid border-slate-200">
		<div class="flex justify-between">
			<div>
				<span v-if="disabled" class="text-slate-700 font-medium outline-none w-full">{{ name }}</span>
				<input v-else :name="`color[${index}][name]`" placeholder="Nazwa" class="text-slate-700 font-medium outline-none w-full" />
				<input :name="`color[${index}][color]`" v-model="color" class="block text-xs font-medium text-slate-500 outline-none mt-2 w-full" />
			</div>
			<ColorPicker v-model="color" class="w-12 h-12 color-picker" />
		</div>
	</div>
</template>

<script>
import ColorPicker from 'primevue/colorpicker';

export default {
	props: {
		index: Number,
		item: String,
		name: String
	},
	components: {
		ColorPicker
	},
	mounted() {
		this.name = this.item.name;
		this.color = this.item.color ? this.item.color : '#ffffff';
	},
	data() {
		return {
			color: null,
			name: '',
			disabled: false
		}
	}
}
</script>
