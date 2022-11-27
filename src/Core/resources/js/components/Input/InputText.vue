<template>
	<InputField :label="label">
		<input type="text" :name="name" v-model="modelValue" /> ???
        <InputError :error="error" />
	</InputField>
</template>

<script>
import InputField from './InputField.vue';
import InputError from './InputError.vue';

export default {
    components: {
        InputField,
        InputError
    },
    props: {
        label: String,
        value: String,
        name: String,
        error: Array
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
