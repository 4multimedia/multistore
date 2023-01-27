<template>
	<div class="flex">
		<div class="w-64">
			<Accordion>
				<AccordionTab header="Strony">
					<input type="text" placeholder="Wyszukaj..." />
					<draggable class="dragArea list-group" :list="list1" tag="ul" :group="{ name: 'people', pull: 'clone', put: false }">
						<li class="list-group-item">
							<div class="navigation-item navigation-item-node" v-for="element in list1" :key="element.name">
								<p>{{ element.name }}</p>
							</div>
						</li>
					</draggable>
				</AccordionTab>
			</Accordion>
		</div>
		<div class="flex-auto pl-3">
			<nested-draggable id="item-1" :items="items" :onLoad="onLoad" />
			<pre>{{ items }}</pre>
		</div>
	</div>
</template>

<script>
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import axios from 'axios';
import NestedDraggable from './Nested.vue';

export default {
	components: {
		Accordion,
		AccordionTab,
		NestedDraggable
	},
	methods: {
		async onLoad() {
			const request = await axios.get('/admin/api/content/navigation');
			const { data } = request;
			this.items = data;
		}
	},
	async mounted() {
		await this.onLoad();
	},
	data() {
		return {
			list1: [
				{ name: "John", id: null, items: [] },
			],
			items: []
		}
	}
}
</script>
