<template>
	<div class="visual-component-element">
		<VisualNested :content="content" />
	</div>
</template>

<script>
export default {
	props: {
		content: Array
	}
}
</script>

<style scoped>
.visual-component-element {
	padding:12px;
	margin:3px;
	border: 1px dashed hsla(0,0%,66.7%,.7);
}
</style>
