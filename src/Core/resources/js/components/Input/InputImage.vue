<template>
	<InputField :label="label" :help="help" :error="error" :required="required" :max="max" :modelValue="modelValue" :column="column">
		wybierz zdjęcie
	</InputField>
</template>

<script>
import InputField from './InputField.vue';

export default {
    components: {
        InputField
    },
    props: {
        label: String,
		placeholder: String,
        value: String,
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
