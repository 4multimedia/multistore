<template>
	<div class="flex items-center mr-auto">
		<PrimeCheckbox v-model="checked" :binary="binary" @input="onChecked" />
		<label class="cursor-pointer select-none ml-2">{{ label }}</label>
	</div>
</template>

<script>
import PrimeCheckbox from 'primevue/checkbox';

export default {
	components: {
		PrimeCheckbox
	},
	props: {
		label: String,
		binary: {
			type: Boolean,
			default: true
		},
		value: {
			type: Boolean,
			default: false
		}
	},
	mounted() {
		this.checked = this.value;
	},
	methods: {
		onChecked(value) {
			this.$emit('update:value', value)
		}
	},
	data() {
		return {
			checked: false
		}
	},

}
</script>
