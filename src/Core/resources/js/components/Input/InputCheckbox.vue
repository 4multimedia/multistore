<template>
	<div class="flex items-center mr-auto">
		<PrimeCheckbox v-model="checked" :binary="binary" />
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
		}
	},
	data() {
		return {
			checked: false
		}
	},

}
</script>
