<template>
    <visual-component :element="element" :style="styles" class="block">
        <component :is="tag">
            <VisualNested :children="element.children" />
        </component>
    </visual-component>
</template>

<script>
import { background, constraints, height } from './../Configuration/index';
import { styleMixin } from './../mixins/styleMixin';

const general = {
    'Podstawowe informacje': [
        {
            id: 'tag',
            name: 'Rodzaj bloku',
            field: 'dropdown',
            options: [
                {name: 'div', id: 'div'},
                {name: 'section', id: 'section'},
                {name: 'aside', id: 'aside'},
                {name: 'header', id: 'header'}
            ]
        },
    ]
}

export default {
	props: {
		element: Object,
	},
	mixins: [styleMixin],
	element: {
        setting: Object.assign(general, height, background, constraints),
        default: {
            minheight: '30',
            tag: 'div'
        }
    },
    computed: {
        tag() {
            return this.getSetting('tag');
        }
    },
}
</script>
