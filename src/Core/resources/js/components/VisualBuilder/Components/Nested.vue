<template>
	<div @drop="onDrop" @dragover="onDragOver" class="drop-nested">
		<div>
			<draggable tag="section" :list="content">
				<div v-for="el, index in content" :key="index">
					<component :is="el.component" :content="el.children" @click="selectElement"></component>
				</div>
			</draggable>
		</div>
	</div>
</template>

<script>
import Draggable from "vuedraggable";

export default {
	props: {
		content: Array
	},
	components: {
		Draggable
	},
	inject: ['components'],
	methods: {
		onDragStart(event) {
			event.dataTransfer.setData("text", event.target.id);
		},
		onDrop(event) {
			var data = event.dataTransfer.getData("text").split(".");
			let component = this.components[data[0]].elements.find(e => e.component === data[1]);
			component = JSON.parse(JSON.stringify(component));
			this.content.push(component);
			event.preventDefault();
			event.stopPropagation();
		},
		onDragOver(event) {
			event.preventDefault();
		}
	}
}
</script>

<style scoped>
.drop-nested {
	padding-bottom: 20px;
	min-height: 30px;;
}
.dragArea {
	min-height: 50px;
	outline: 1px dashed;
}
</style>
