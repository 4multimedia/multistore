<template>
	<div>
		<button
			v-for="item in breakpoints"
			:key="item.name"
			@click="onHandleChangeBreakpoint(item.id)"
			class="btn btn-outline-dark"
		>
			{{ item.name }}
		</button>
	</div>
</template>

<script>
	export default {
		props: {
			breakpoint: Object,
			breakpoints: Array
		},
		methods: {
			onHandleChangeBreakpoint(id) {
				const item = this.breakpoints.find(e => e.id === id);
				this.$emit("update:breakpoint", item);
			}
		}
	}
</script>
