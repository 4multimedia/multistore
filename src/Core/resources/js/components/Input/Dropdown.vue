<template>
    <InputField :label="label" :help="help" :error="error" :modelValue="modelValue" :column="column">
        <PrimeDropdown :options="options" v-model="modelValue" :value="modelValue" @input="onChange($event)" optionValue="id" optionLabel="name" />
    </InputField>
</template>

<script>
import InputField from './InputField.vue';
import PrimeDropdown from 'primevue/dropdown';

export default {
    components: {
        InputField,
        PrimeDropdown
    },
    props: {
        label: String,
        value: [Number, String],
		help: String,
        name: String,
        error: Array,
        options: Array,
        column: {
            type: Boolean,
            default: false
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
