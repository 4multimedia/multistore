<template>
	<InputField :label="label" :help="help" :error="error" :max="max" :modelValue="modelValue" :column="column">
		<PrimeInputText class="form-control" :help="help" :name="name" v-model="modelValue" :placeholder="label" :maxlength="max" @input="onChange($event)" />
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
        value: String,
		help: String,
        name: String,
        error: Array,
		max: Number,
        column: {
            type: Boolean,
            default: false
        }
    },
    mounted() {
        this.modelValue = this.value;
    },
    methods: {
        onChange(value) {
            this.$emit('update:value', value)
        }
    },
    data() {
        return {
            modelValue: ''
        }
    }
}
</script>
