<template>
	<div class="flex">
		<div class="w-[300px]">
			<Accordion>
				<AccordionTab v-for="group, index in groups" :key="index" :header="group.label">
					<input type="text" placeholder="Wyszukaj..." />
					<draggable class="dragArea list-group" :list="group.items" tag="ul" :group="{ name: 'people', pull: 'clone', put: false }">
						<li class="list-group-item" v-for="element in group.items" :key="element.name">
							<div class="navigation-item navigation-item-node">
								<p>{{ element.name }}</p>
							</div>
						</li>
					</draggable>
				</AccordionTab>
			</Accordion>
		</div>
		<div class="flex-auto pl-3">
			<nested-draggable :id="`item-${id}`" :items="items" :onLoad="onLoad" />
		</div>
        <ConfirmDialog></ConfirmDialog>
	</div>
</template>

<script>
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import axios from 'axios';
import NestedDraggable from './Nested.vue';
import ConfirmDialog from 'primevue/confirmdialog';

export default {
	components: {
        ConfirmDialog,
		Accordion,
		AccordionTab,
		NestedDraggable
	},
	methods: {
		async onLoad() {
			const request = await axios.get(`/admin/api/content/navigation/${this.hash}`);
			const { data } = request;
			this.items = data;
		}
	},
	async mounted() {
		await this.onLoad();
	},
    props: {
        groups: Array,
        hash: String,
        id: Number,
    },
	data() {
		return {
			items: []
		}
	}
}
</script>
