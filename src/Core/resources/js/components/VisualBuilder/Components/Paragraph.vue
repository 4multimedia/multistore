<template>
    <visual-component :element="element" :style="styles">
	    <component :is="tag">{{ text }}</component>
    </visual-component>
</template>

<script>
import Component from './Component.vue';
import { typography, constraints } from './../Configuration/index';
import { styleMixin } from './../mixins/styleMixin';

export default {
    components: { Component },
    mixins:[styleMixin],
	props: {
		element: Object,
	},
    element: {
        setting: Object.assign({
			'Podstawowe informacje': [
                { id: 'text', name: 'Tekst', field: 'input-text' },
                { id: 'tag', name: 'Tag HTML', field: 'dropdown', options: [
					{'id': 'p', 'name' : 'Paragraf - <p></p>'},
					{'id': 'span', 'name' : 'Zasięg - <span></span>'},
					{'id': 'div', 'name' : 'Blok - <div></div>'},
					{'id': 'h1', 'name' : 'Nagłówek H1 - <h1></h1>'}
				]}
            ]}, typography, constraints),
        default: {
            text: 'Wpisz tekst',
            tag: 'p'
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
