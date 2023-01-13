<template>
	<div class="flex">
		<aside class="visual-component-list">
			<div v-for="component, index in components" :key="index">
				<h4>{{ component.name }}</h4>
				<draggable
					tag="ul"
					:list="component.elements"
					:clone="onCloneItem"
					v-bind="{group:{ name: 'visualComponents', pull: true, put: false }, sort:false, ghostClass: 'ghost'}"
				>
					<li v-for="element, index in component.elements" :key="index">
						{{ element.component }}
					</li>
				</draggable>
			</div>
		</aside>
		<div class="visual-main">
			<VisualNested :tasks="content" />
		</div>
		<aside class="visual-configurator">
			<pre>{{ content }}</pre>
		</aside>
	</div>
</template>

<script>
import Draggable from "vuedraggable";

export default {
	components: {
		Draggable
	},
	data() {
		return {
			components: {
				basic: {
					name: 'Podstawowe',
					elements: [
						{name: 'Element blokowy', component: 'visual-block', tasks: [], nested: true},
						{name: 'Element blokowy', component: 'visual-block', tasks: [], nested: true},
						{name: 'Element blokowy', component: 'visual-block', tasks: [], nested: true},
						{name: 'Element blokowy', component: 'visual-block', tasks: [], nested: true},
						{name: 'Paragraf', component: 'visual-paragraph', tasks: [], nested: false}
					]
				}
			},
			content: []
		}
	},
	methods: {
		onHandleMoveEnd(event) {

		},
		onHandleMoveStart(item) {
			console.log(item);
		},
		onHandleMove() {

		},
		onHandleAddToComponent(item) {
			console.log(item);
		},
		onCloneItem(item) {
			const el = JSON.parse(JSON.stringify(item));
			el.uuid = 1;
			console.log(el);

			this.content.push(el);
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
