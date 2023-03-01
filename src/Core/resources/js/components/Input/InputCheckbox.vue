<template>
	<div class="flex mr-auto" :class="{'items-center' : center}">
		<PrimeCheckbox v-bind="$attrs" :name="name" v-model="checked" :binary="binary" @input="onChecked($event)"/>
		<label class="cursor-pointer select-none ml-2" v-html="label"></label>
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
        name: String,
		binary: {
			type: Boolean,
			default: true
		},
		value: {
			type: Boolean,
			default: false
		},
        callback: Function,
        center: {
            type: Boolean,
            default: true
        }
	},
	mounted() {
		this.checked = this.value;
	},
	methods: {
		onChecked(value) {
            if (this.callback !== undefined) {
                this.callback(value, this.name);
            }
			this.$emit('update:value', value)
		}
	},
    watch: {
        value() {
            this.checked = this.value;
        }
    },
	data() {
		return {
			checked: false
		}
	},

}
</script>
