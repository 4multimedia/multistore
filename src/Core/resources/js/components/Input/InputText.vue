<template>
	<InputField :label="label">
		<input type="text" />
	</InputField>
</template>

<script setup>
import InputField from './InputField.vue';

defineProps({
	label: String,
	value: String
})
</script>
