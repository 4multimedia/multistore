<template>
    <InputField :label="label" :help="help" :error="error" :max="max" :modelValue="modelValue" :column="column">
        <PrimeDropdown />
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
        value: String,
		help: String,
        name: String,
        error: Array,
        column: {
            type: Boolean,
            default: false
        }
    },
}
</script>
