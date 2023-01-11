<template>
	<InputField :label="label" :help="help" :error="error" :required="required" :max="max" :modelValue="modelValue" :column="column">
		<PrimeInputSwitch :name="name" v-model="modelValue" @input="onChange($event)" />
	</InputField>
</template>

<script>
import InputField from './InputField.vue';
import PrimeInputSwitch from 'primevue/inputswitch';

export default {
    components: {
        InputField,
        PrimeInputSwitch,
    },
    props: {
        label: String,
		placeholder: String,
        value: {
			type: Boolean,
			default: false
		},
		help: String,
        name: String,
        error: Array,
		max: Number,
        column: {
            type: Boolean,
            default: false
        },
        required: {
            type: Boolean,
            default: false
        }
    },
    mounted() {
        this.modelValue = this.value;
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
    watch: {
        value() {
            this.modelValue = this.value;
        }
    },
    data() {
        return {
            modelValue: ''
        }
    }
}
</script>
