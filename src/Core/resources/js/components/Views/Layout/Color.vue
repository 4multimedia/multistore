<template>
	<div class="intro-x p-3 rounded-md border border-solid border-slate-200">
		<div class="flex justify-between">
			<div>
				<span v-if="disabled" class="text-slate-700 font-medium outline-none w-full">{{ color_name }}</span>
				<input v-else :name="`${name}[${index}][name]`" placeholder="Nazwa" :value="color_name" class="text-slate-700 font-medium outline-none w-full" />
				<input :name="`${name}[${index}][color]`" v-model="color" class="block text-xs font-medium text-slate-500 outline-none mt-2 w-full" />
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
		this.color = this.item.color ? this.item.color : '#ffffff';
		this.color_name = this.item.name;
		this.disabled = this.item.disabled ? this.item.disabled : false;
	},
	data() {
		return {
			color: null,
			color_name: null,
			disabled: false
		}
	}
}
</script>
