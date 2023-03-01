<template>
    <div>
        <input type="hidden" :name="name" v-model="modelValue" />
        <InputField :label="label" :required="required" :help="help" :error="error" :modelValue="modelValue" :column="column">
            <PrimeDropdown :options="values" v-model="modelValue" :value="modelValue" @input="onChange($event)" optionValue="id" optionLabel="name" />
        </InputField>
    </div>
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
        },
        required: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        onChange(value) {
            this.$emit('onChangeValue', value);
            this.$emit('update:value', value);
        }
    },
    watch: {
        value() {
            this.modelValue = this.value.toString();
        },
        options() {
            if (typeof(this.options) === 'string') {
                this.options = JSON.parse(this.options);
            }
        }
    },
	computed: {
		values() {
			let array = [];
			this.options.forEach(e => {
				array.push({ id: e.id.toString(), name: e.name });
			})
			return array;
		}
	},
    data() {
        return {
            modelValue: ''
        }
    },
    created() {
        if (typeof(this.options) === 'string') {
            this.options = JSON.parse(this.options);
        }
        this.modelValue = this.value.toString();
    },
}
</script>
