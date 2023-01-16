<template>
    <visual-component :element="element">
		<div>
			<VisualNested :children="element.children" class="visual-setting-class-flex" :clone="false" :put="false" :group="`visualComponents-${makeid(8)}`" />
		</div>
    </visual-component>
</template>

<script>
import Component from './Component.vue';
import { background, height } from './../helpers/Style';

export default {
  components: { Component },
	props: {
		element: Object,
		makeid: Function
	},
    element: {
        setting: [
            {
                'Podstawowe': {
                    'Podstawowe informacje': [
                        {
							id: 'rows',
							name: 'Ilość kolumn',
							field: 'dropdown',
							options: [
								{id: 1, name: '1 kolumna'},
								{id: 2, name: '2 kolumny'},
								{id: 3, name: '3 kolumny'},
								{id: 4, name: '4 kolumny'},
								{id: 5, name: '5 kolumn'},
								{id: 6, name: '6 kolumn'},
								{id: 7, name: '7 kolumn'},
								{id: 8, name: '8 kolumn'},
								{id: 9, name: '9 kolumn'},
								{id: 10, name: '10 kolumn'},
								{id: 11, name: '11 kolumn'},
								{id: 12, name: '12 kolumn'},
							],
							optionLabel: 'label',
							optionValue: 'value'
						},
                    ]
                },
            },
            {
                'Style': {
                    background,
                    height
                },
            },
            {
                'Zaawansowane': {}
            }
        ],
        default: {
            rows: 0,
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
	watch: {
		rows: function (after, before) {
			const element = this.$store.state.layout.current;
			for(let a = 1; a <= this.rows; a++) {
				element.children.push({
					"name": "Element blokowy",
					"component": "visual-block",
					"children": [],
					"uuid": this.makeid(8),
					"setting": [],
                    "nested": true,
					"accepted": ['*'],
				});
			}
		}
	},
    computed: {
        rows() {
            return this.getSetting('rows');
        },
		elements() {
			const list = [];
			for(let a = 1; a <= this.rows; a++) {
				list.push({id: a });
			}
			return list;
		}
    },
    data() {
        return {
            options: {}
        }
    }
}
</script>
