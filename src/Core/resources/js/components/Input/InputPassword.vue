<template>
	<InputField :label="label">
		<input type="password" :name="name" v-model="modelValue" />
        <InputError :error="error" />
	</InputField>
</template>

<script>
import InputField from './InputField.vue';
import InputError from './InputError.vue';

export default {
    components: {
        InputError,
        InputField
    },
    props: {
        label: String,
        value: String,
        name: String,
        error: Array
    },
    data() {
        return {
            modelValue: '',
        }
    },
    mounted() {
        this.modelValue = this.value;
    },
}
</script>

