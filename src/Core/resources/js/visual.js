import VisualParagraph from './components/VisualBuilder/Components/Paragraph';
import VisualBlock from './components/VisualBuilder/Components/Block';

const elements = [];
elements['visual-paragraph'] = VisualParagraph.element;
elements['visual-block'] = VisualBlock.element;

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
			{name: 'Element blokowy', component: 'visual-block', children: [], nested: true, configuration: getConfiguration('visual-block')},
			{name: 'Paragraf', component: 'visual-paragraph', children: [], nested: false, configuration: getConfiguration('visual-paragraph')}
		]
	}
};

export default components;
