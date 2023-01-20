<template>
	<InputField :label="label" :required="required" :help="help" :error="error" :max="max" :modelValue="modelValue" :column="column">
		{{ modelValue }}
		<PrimeSelectButton v-model="modelValue" :options="options" :optionLabel="optionLabel" :optionValue="optionValue" @input="onChange($event)" />
	</InputField>
</template>

<script>
import InputField from './InputField.vue';
import PrimeSelectButton from 'primevue/selectbutton';

export default {
	components: {
		InputField,
		PrimeSelectButton
	},
	props: {
        label: String,
		placeholder: String,
        value: String,
		help: String,
        name: String,
        error: Array,
		max: Number,
		options: Array,
		optionLabel: {
			type: String,
			default: 'name'
		},
		optionValue: {
			type: String,
			default: 'id'
		},
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
	methods: {
        onChange(value) {
            this.$emit('onChangeValue', value);
            this.$emit('update:value', value);
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
