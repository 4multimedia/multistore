<template>
	<div>
		<div class="grid xl:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-4 views-layout-colors">
			<ColorItem v-for="item, index in items" :key="index" :index="index" :item="item" />
		</div>

		<div class="flex justify-end">
			<button class="btn w-32 mt-5" @click="onHandleAddColor">Dodaj kolor</button>
		</div>
	</div>
</template>

<script>
import ColorItem from './Color.vue';

export default {
	props: {
		colors: Array,
	},
	components: {
		ColorItem,
	},
	data() {
		return {
			items: []
		}
	},
	methods: {
		onHandleAddColor() {
			this.items.push({ name: '', color: '' });
		}
	}
}
</script>
