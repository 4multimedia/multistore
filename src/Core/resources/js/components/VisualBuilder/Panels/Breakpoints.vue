<template>
	<button v-for="item in items" :key="item.name">{{ item.name }}</button>
</template>

<script>
	export default {
		data() {
			return {
				items: [
					{name: 'XXL', size: '1400', full: true},
					{name: 'XL', size: '1200', full: true},
					{name: 'LG', size: '992', full: true},
					{name: 'MD', size: '768', full: true},
					{name: 'SM', size: '576', full: true},
					{name: 'XS', size: '576', full: true},
				]
			}
		}
	}
</script>
