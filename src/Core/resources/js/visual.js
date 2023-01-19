import Vue from 'vue';

import VisualParagraph from './components/VisualBuilder/Components/Paragraph';
import VisualBlock from './components/VisualBuilder/Components/Block';
import VisualGrid from './components/VisualBuilder/Components/Grid';
import VisualNavigation from './components/VisualBuilder/Components/Navigation';
import VisualContainer from './components/VisualBuilder/Components/Container';

const elements = [];
elements['visual-paragraph'] = VisualParagraph.element;
elements['visual-block'] = VisualBlock.element;
elements['visual-container'] = VisualContainer.element;
elements['visual-grid'] = VisualGrid.element;
elements['visual-navigation'] = VisualNavigation.element;

Vue.component('VisualGrid', VisualGrid);
Vue.component('VisualParagraph', VisualParagraph);
Vue.component('VisualBlock', VisualBlock);
Vue.component('VisualContainer', VisualContainer);
Vue.component('VisualNavigation', VisualNavigation);

function getConfiguration (key) {
    const configuration = elements[key];
    if (configuration === undefined) {
        return {
            setting: [],
            default: []
        }
    }
    return configuration;
}

const components = {
	layout: {
		name: 'Elementy blokowe',
		elements: [
			{
				name: 'Układ kolumnowy',
				component: 'visual-flex',
				children: [],
                accepted: ['visual-col'],
				icon: 'Columns',
                nested: true,
				configuration: getConfiguration('visual-flex')
			},
			{
				name: 'Układ siatkowy',
				component: 'visual-grid',
				children: [],
                accepted: ['visual-col'],
				icon: 'Grid',
                nested: true,
				configuration: getConfiguration('visual-grid')
			},
			{
				name: 'Element blokowy',
				component: 'visual-block',
				children: [],
                accepted: ['*'],
                nested: true,
				icon: 'LayoutTemplate',
				configuration: getConfiguration('visual-block')
			},
			{
				name: 'Kontener',
				component: 'visual-container',
				children: [],
                accepted: ['*'],
                nested: true,
				icon: 'ChevronsRightLeft',
				configuration: getConfiguration('visual-container')
			}
		]
	},
	basic: {
		name: 'Podstawowe',
		elements: [
			{
				name: 'Nawigacja',
				component: 'visual-navigation',
				children: [],
                accepted: [],
				icon: 'Menu',
                nested: false,
				configuration: getConfiguration('visual-navigation')
			},
			{
				name: 'Paragraf',
				component: 'visual-paragraph',
				children: [],
				nested: false,
				icon: 'Baseline',
				configuration: getConfiguration('visual-paragraph')
			},
			{
				name: 'Pole HTML',
				component: 'visual-paragraph',
				children: [],
				nested: false,
				icon: 'Code2',
				configuration: getConfiguration('visual-paragraph')
			},
			{
				name: 'Ikona',
				component: 'visual-paragraph',
				children: [],
				nested: false,
				icon: 'Star',
				configuration: getConfiguration('visual-paragraph')
			}
		]
	}
};

console.log(components);

export default components;
