<template>
	<nav class="side-nav">
		<items :items="menus" :route="route"></items>
	</nav>
</template>

<script>
	import Items from './Items.vue';

	export default {
		props: {
			items: String,
			route: String,
		},
		components: {
			Items,
		},
		computed: {
			menus() {
				return JSON.parse(this.items);
			},
		}
	}
</script>
