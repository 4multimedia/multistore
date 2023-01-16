<template>
	<div class="visual-area flex">
		<aside class="visual-component-list">
            <Accordion>
                <AccordionTab v-for="component, index in components" :header="component.name" :key="index">
                    <draggable
                        tag="section"
                        :list="component.elements"
                        :clone="onCloneItem"
                        :options="{ group:{ name:'visualComponents',  pull:'clone', put: false }, sort:false, ghostClass: 'ghost' }"
                    >
                        <div v-for="element, element_index in component.elements" :key="element_index" :id="`${index}.${element.component}`">
                            <Pilcrow :size="28" class="mb-3 text-slate-300" />
                            <p>{{ element.name }}</p>
                        </div>
                    </draggable>
                </AccordionTab>
            </Accordion>
		</aside>
		<div class="visual-main">
			<VisualNested :children="content" class="visual-element first" root />
		</div>
		<aside class="visual-configurator">
            <VisualConfigurator />
            <pre>{{ content }}</pre>
            <Tree :value="tree" label="name" key="uuid"></Tree>
		</aside>
	</div>
</template>

<script>
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import Draggable from "vuedraggable";
import Tree from 'primevue/tree';
import VisualConfigurator from './Panel/Configurator.vue';
import { Pilcrow } from 'lucide-vue';

export default {
	components: {
        Pilcrow,
        Accordion,
        AccordionTab,
		Draggable,
        Tree,
        VisualConfigurator
	},
    inject: ['components'],
    computed: {
        content() {
            return this.$store.state.layout.content;
        },
        tree() {
            return this.$store.state.layout.content;
        }
    },
    mounted() {

    },
	methods: {
		onHandleMoveEnd(event) {

		},
		onHandleMoveStart(item) {
			console.log(item);
		},
		onHandleMove() {

		},
		onHandleAddToComponent(item) {
			console.log(item);
		},
		onCloneItem(item) {

		}
	}
}
</script>
