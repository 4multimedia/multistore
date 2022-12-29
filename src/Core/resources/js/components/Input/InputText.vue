<template>
	<InputField :label="label" :help="help" :error="error" :max="max" :modelValue="modelValue" :column="column">
		<input type="text" class="form-control" :help="help" :name="name" v-model="modelValue" :placeholder="label" :maxlength="max" @input="onChange($event)" />
	</InputField>
</template>

<script>
import InputField from './InputField.vue';

export default {
    components: {
        InputField,
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
        onChange(e) {
            this.$emit('update:value', e.target.value)
        }
    },
    data() {
        return {
            modelValue: ''
        }
    }
}
</script>
