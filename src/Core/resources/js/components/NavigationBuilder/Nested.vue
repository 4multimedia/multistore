<template>
	<draggable class="dragArea list-group" :list="items" group="people">
		<div class="list-group-item" v-for="element in items" :key="element.name">
			{{ element.name }}
			<div style="border:1px solid #ccc; min-height:50px;">
				<nested-draggable :items="element.items" />
			</div>
		</div>
	</draggable>
</template>

<script>
export default {
	props: {
		items: Array
	},
	display: "Nested",
	order: 15,
	name: "nested-draggable"
}
</script>
