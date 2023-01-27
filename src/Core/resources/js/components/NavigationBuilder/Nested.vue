<template>
	<draggable class="dragArea list-group" tag="ul" :list="items" group="people" @add="onAdd" @remove="onMove" @end="onEnd" @change="onChange" draggable=".list-group-item">
		<li class="list-group-item" v-for="element in items" :key="element.name">
			<div class="navigation-item" :id="`clone-${element.id}`">
				<div class="flex navigation-item-content items-center justify-between">
					<p>{{ element.route }}</p>
					<div class="flex">
						<div><Settings class="w-4 h-4 ml-2" /></div>
						<div><Trash2 class="w-4 h-4 ml-2" /></div>
					</div>
				</div>
			</div>
			<div style="padding-left:1rem;">
				<nested-draggable :id="`item-${element.id}`" :items="element.items" :onLoad="onLoad" />
			</div>
		</li>
	</draggable>
</template>

<script>
import axios from 'axios';
import { Trash2, Settings } from 'lucide-vue';

export default {
	props: {
		items: Array,
		onLoad: Function
	},
	components: {
		Settings,
		Trash2,
	},
	display: "Nested",
	order: 15,
	name: "nested-draggable",
	data() {
		return {
			node: {},
			clone: {}
		}
	},
	methods: {
		async onChange(e) {
			this.node = {};
			if (e.removed !== undefined) {
				this.node = e.removed.element;
			}
			if (e.moved !== undefined) {
				this.node = e.moved.element;
				await axios.put('/admin/api/content/navigation/position', {
					item: {
						id: e.moved.element.id,
						position: e.moved.newIndex
					}
				});
			}
		},
		async onAdd(e) {
			this.clone = e;
			//console.log(e);
			if (e.pullMode === 'clone') {
				try {
					await axios.post('/admin/api/content/navigation', {
						item: {
							id_navigation_parent: e.to.id.replace("item-", ""),
							name: 'Nazwa menu-'+e.to.id.replace("item-", ""),
							position: e.newIndex,
							route: '',
							module: '',
							id_record: ''
						}
					});
					await this.onLoad();
				} catch(e) {
					console.log(e);
				}
			}
		},
		async onMove(e) {
			const item = document.querySelector(`#clone-${this.node.id}`);
			await axios.put('/admin/api/content/navigation/move', {
				item: {
					id: this.node.id,
					id_navigation_parent: parseInt(item.parentNode.parentNode.id.replace("item-", "")),
					position: e.newIndex
				}
			});
		},
		onEnd(e) {
			//console.log(e);
		}
	}
}
</script>
