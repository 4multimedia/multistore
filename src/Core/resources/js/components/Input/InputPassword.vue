<template>
	<InputField :label="label">
		<input type="password" />
	</InputField>
</template>

<script setup>
import InputField from './InputField.vue';

defineProps({
	label: String,
	value: String
})
</script>
