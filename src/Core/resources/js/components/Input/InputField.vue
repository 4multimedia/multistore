<template>
	<div>
		<label>{{ label }}</label>
		<slot />
	</div>
</template>

<script>
    export default {
        props: {
            label: String
        }
    }
</script>
