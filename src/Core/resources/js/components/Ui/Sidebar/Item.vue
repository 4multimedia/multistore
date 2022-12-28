<template>
	<li>
		<a
			:href="item.path ? item.path : 'javascript:;'"
			@click="openMenu(item.items.length > 0 ? true : false, i)"
			class="side-menu"
			:class="`${item.route === route ? 'side-menu--active' : ''}`"
		>
			<div class="side-menu__title">
				{{ item.label }}
				<div v-if="item.items.length > 0" class="side-menu__sub-icon" :class="`${i === current ? ' transform rotate-180' : ''}`"> <component :is="icon('ChevronDown')" /></div>
			</div>
		</a>

		<template v-if="item.items.length > 0">
			<ul :class="`${i === current ? 'side-menu__sub-open' : ''}`">
				<li v-for="item, index in item.items" :key="index">
					<a :href="item.path ? item.path : 'javascript:;'" class="side-menu" :class="`${item.route === route ? 'side-menu--active' : ''}`">
						<div class="side-menu__title">
							{{ item.label }}
						</div>
					</a>
				</li>
			</ul>
		</template>
	</li>
</template>

<script>
	import * as icons from 'lucide-vue';

	export default {
		data() {
			return {
				current: null
			}
		},
		props: {
			item: Object,
			route: String,
			i: [String, Number]
		},
		computed: {
			currentRoute() {

			}
		},
		methods: {
			icon(key) {
				return icons[key];
			},
			openMenu(status, item) {
				if (status) {
					if (item === this.current) {
						this.current = null;
					} else {
						this.current = item;
					}
				}
			}
		}
	}
</script>
