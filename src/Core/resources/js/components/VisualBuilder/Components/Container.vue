<template>
    <visual-component :element="element">
        <div class="container">
            <VisualNested :children="element.children" />
        </div>
    </visual-component>
</template>

<script>
export default {
	props: {
		element: Object,
	},
}
</script>
