import Vue from 'vue';

import VisualParagraph from './components/VisualBuilder/Components/Paragraph';
import VisualBlock from './components/VisualBuilder/Components/Block';
import VisualGrid from './components/VisualBuilder/Components/Grid';
import VisualNavigation from './components/VisualBuilder/Components/Navigation';

const elements = [];
elements['visual-paragraph'] = VisualParagraph.element;
elements['visual-block'] = VisualBlock.element;
elements['visual-grid'] = VisualGrid.element;
elements['visual-navigation'] = VisualNavigation.element;

Vue.component('VisualGrid', VisualGrid);
Vue.component('VisualParagraph', VisualParagraph);
Vue.component('VisualBlock', VisualBlock);
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
	basic: {
		name: 'Podstawowe',
		elements: [
			{
				name: 'Grid',
				component: 'visual-grid',
				children: [],
                accepted: ['visual-col'],
				configuration: getConfiguration('visual-grid')
			},
			{
				name: 'Element blokowy',
				component: 'visual-block',
				children: [],
                accepted: ['*'],
				configuration: getConfiguration('visual-block')
			},
			{
				name: 'Nawigacja',
				component: 'visual-navigation',
				children: [],
                accepted: [],
				configuration: getConfiguration('visual-navigation')
			},
			{
				name: 'Paragraf',
				component: 'visual-paragraph',
				children: [],
				nested: [],
				configuration: getConfiguration('visual-paragraph')
			}
		]
	}
};

export default components;
