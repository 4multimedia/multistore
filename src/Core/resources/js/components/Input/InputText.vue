<template>
	<InputField :label="label" :help="help" :error="error" :max="max" :modelValue="modelValue">
		<input type="text" class="form-control" :help="help" :name="name" v-model="modelValue" :placeholder="label" :maxlength="max" />
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
		max: Number
    },
    mounted() {
        this.modelValue = this.value;
    },
    data() {
        return {
            modelValue: ''
        }
    }
}
</script>
