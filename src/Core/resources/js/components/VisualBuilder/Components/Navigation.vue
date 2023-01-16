<template>
	<visual-component :element="element">
		<nav>
			<ul>
				<li>Menu</li>
			</ul>
		</nav>
	</visual-component>
</template>

<script>
import Component from './Component.vue';
export default {
  components: { Component },
	props: {
		element: Object,
	},
    element: {
        setting: [
            {
                'Podstawowe': {
                    'Podstawowe informacje': [
                        { id: 'id_menu', name: 'Wybierz menu', field: 'dropdown' },
                    ]
                },
            },
            {
                'Style': {
                    'Typografia': [
                        { id: 'font.family', name: 'Czcionka', field: 'input-text' },
                    ]
                },
            },
            {
                'Zaawansowane': {}
            }
        ],
        default: {}
    },
    methods: {
        getSetting(key) {
            if (this.element && this.element.setting && this.element.setting[key]) {
                return this.element.setting[key];
            }
            return '';
        }
    },
    computed: {

    },
    data() {
        return {
            options: {}
        }
    }
}
</script>
