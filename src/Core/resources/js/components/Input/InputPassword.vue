<template>
	<InputField :label="label" :help="help" :error="error" :max="max" :modelValue="modelValue" :column="column">
		<PrimeInputPassword :help="help" :name="name" v-model="modelValue" :placeholder="getplaceholder" :maxlength="max" @input="onChange($event)" v-bind="$attrs" />
	</InputField>
</template>

<script>
import InputField from './InputField.vue';
import PrimeInputPassword from 'primevue/password';

export default {
    components: {
        InputField,
		PrimeInputPassword
    },
    props: {
        label: String,
		placeholder: String,
        value: String,
		help: String,
        name: String,
        error: Array,
		max: Number,
		toogleMask: {
			type: Boolean,
			default: true
		},
        column: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            modelValue: '',
        }
    },
	computed: {
		getplaceholder() {
			if (this.placeholder) {
				return this.placeholder;
			} else if (this.label) {
				return this.label;
			} else {
				return null;
			}
		}
	},
    methods: {
        onChange(value) {
            this.$emit('update:value', value)
        }
    },
    mounted() {
        this.modelValue = this.value;
    },
}
</script>

