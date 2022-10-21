<template>
	<div>
		<label>{{ label }}</label>
		<slot />
	</div>
</template>

<script setup>
defineProps({
	label: String
})
</script>
