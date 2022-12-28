<template>
	<ul class="">
		<Item v-for="item, index in items" :key="index" :item="item" :route="route" :i="index" />
	</ul>
</template>

<script>
	import Item from './Item.vue';

	export default {
		props: {
			items: Object,
			route: String
		},
		components: {
			Item,
		}
	}
</script>
