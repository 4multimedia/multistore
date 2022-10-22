<template>
	<InputField :label="label">
		<input type="text" :name="name" v-model="modelValue" />
        <InputError :error="error" />
	</InputField>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import InputField from './InputField.vue';
import InputError from './InputError.vue';

const props = defineProps({
	label: String,
	value: String,
    name: String,
    error: Array
});

const modelValue = ref();

onMounted(() => {
    modelValue.value = props.value;
})
</script>
