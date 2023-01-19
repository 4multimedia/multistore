<template>
    <visual-component :element="element">
	    <component :is="tag">{{ text }}</component>
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
        setting: {
			'Podstawowe informacje': [
                { id: 'text', name: 'Tekst', field: 'input-text' },
                { id: 'tag', name: 'Tag HTML', field: 'dropdown', options: [
					{'id': 'p', 'name' : 'Paragraf - <p></p>'},
					{'id': 'span', 'name' : 'Zasięg - <span></span>'},
					{'id': 'div', 'name' : 'Blok - <div></div>'},
					{'id': 'h1', 'name' : 'Nagłówek H1 - <h1></h1>'}
				]}
            ],
			'Typografia': [
                { id: 'font.family', name: 'Czcionka', field: 'input-text' },
            ]
        },
        default: {
            text: 'Wpisz tekst',
            tag: 'p'
        }
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
        text() {
            return this.getSetting('text');
        },
        tag() {
            return this.getSetting('tag');
        }
    },
    data() {
        return {
            options: {}
        }
    }
}
</script>
