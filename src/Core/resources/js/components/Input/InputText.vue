<template>
	<InputField :label="label" :required="required" :help="help" :error="error" :max="max" :modelValue="modelValue" :column="column">
		<PrimeInputText class="form-control" :help="help" :name="name" v-model="modelValue" :placeholder="getplaceholder" :maxlength="max" @input="onChange($event)" />
	</InputField>
</template>

<script>
import InputField from './InputField.vue';
import PrimeInputText from 'primevue/inputtext';

export default {
    components: {
        InputField,
        PrimeInputText,
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
    methods: {
        onChange(value) {
            this.$emit('onChangeValue', value);
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
