<template>
	<div class="flex">
		<aside class="visual-component-list">
			<div v-for="component, index in components" :key="index">
				<h4>{{ component.name }}</h4>
				<ul>
					<li v-for="element, index2 in component.elements" :key="index2" >
						<div @dragstart="onDragStart" draggable="true" :id="`${index}.${element.component}`">{{ element.component }}</div>
					</li>
				</ul>
			</div>
		</aside>
		<div class="visual-main">
			<visual-nested :content="content"></visual-nested>
		</div>
		<aside class="visual-configurator">
			<pre>{{ content }}</pre>
		</aside>
	</div>
</template>

<script>

export default {
	data() {
		return {
			components: {
				basic: {
					name: 'Podstawowe',
					elements: [
						{name: 'Element blokowy', component: 'visual-block', tasks: [], nested: true},
						{name: 'Paragraf', component: 'visual-paragraph', tasks: [], nested: false}
					]
				}
			},
			content: []
		}
	},
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
		},
		onDragOver(event) {
			event.preventDefault();
		}
	}
}
</script>

<style scoped>
.flex {
	display: flex;
}
.visual-component-list {
	flex:0 0 300px;
}
.visual-main {
	flex:1;
	min-height: 100vh;
	border:1px solid #f00;
}
.visual-configurator {
	flex:0 0 300px;
}
.visual-main-form {
	min-height: 100vh;
}
.dragArea {
	min-height: 50px;
	outline: 1px dashed;
}
</style>
