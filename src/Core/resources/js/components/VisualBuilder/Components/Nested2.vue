<template>
	<draggable tag="ul" :list="tasks" group="visualComponents">
		<li v-for="el, index in tasks" :key="index">
			<component :is="el.component" :tasks="el.tasks" />
		</li>
	</draggable>
</template>

<script>
import Draggable from "vuedraggable";

export default {
	components: {
		Draggable
	},
	props: {
		tasks: {
			required: true,
      		type: Array
		}
	},
	methods: {
		onHandleAdItem() {
			alert('dodane');
		}
	}
}
</script>

<style scoped>
.dragArea {
	min-height: 50px;
	outline: 1px dashed;
}
</style>
