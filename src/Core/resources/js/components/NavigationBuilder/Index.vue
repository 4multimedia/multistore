<template>
	<div class="flex">
		<div class="w-64">
			<draggable class="dragArea list-group" :list="list1" :group="{ name: 'people', pull: 'clone', put: false }">
				<div class="list-group-item" v-for="element in list1" :key="element.name">
					{{ element.name }}
				</div>
			</draggable>
		</div>
		<div class="flex-auto">
			{{ wait }}
			<nested-draggable :items="items" />

			<pre>{{ items }}</pre>
		</div>
	</div>
</template>

<script>
import axios from 'axios';
import NestedDraggable from './Nested.vue';

export default {
	components: {
		NestedDraggable
	},
	watch: {
		async items() {
			if (this.wait === false) {
				this.wait = true;
				try {
					const request = await axios.post('/admin/api/content/navigation', { items: this.items });
					this.items = JSON.parse(JSON.stringify(this.items));
					setTimeout(() => { this.wait = false; }, 100);
				} catch(e) {
					setTimeout(() => { this.wait = false; }, 100);
				}
			}
		}
	},
	data() {
		return {
			wait: false,
			list1: [
				{ name: "John", id: 1, items: [] },
			],
			items: [
				{ name: "John", id: 1, items: [] },
			]
		}
	}
}
</script>
