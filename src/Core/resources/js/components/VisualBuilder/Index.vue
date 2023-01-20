<template>
	<div class="visual-area h-full flex flex-col">
		<header class="h-16 border-b border-slate-300 bg-white flex">
			<div class="w-24 h-16 border-r flex justify-center items-center border-slate-300">
				<button class="w-10 h-10 rounded-lg flex justify-center items-center text-slate-500 bg-slate-100 hover:text-white hover:bg-blue-300 transition-all">
					<component :is="icon('ChevronLeft')" :size="20" />
				</button>
			</div>
			<div class="flex-auto">
				<div class="flex justify-between px-4">
					<div class="flex">
						<div>
							Nazwa
						</div>
						<div>
							Rodzaj
						</div>
					</div>
					<div class="h-16 flex items-center">
						<div class="mr-4">
							Szerokość ekranu
							<small class="block text-slate-500">1200 px</small>
						</div>
						<div class="flex mr-4">
							<button class="w-10 h-10 rounded-lg ml-2 flex justify-center items-center hover:text-blue-600 hover:bg-blue-200 transition-all" :class="{'bg-blue-500 text-white': breakpoint == 'xxl', 'text-slate-500 bg-slate-100': breakpoint != 'xxl'}">
								<component :is="icon('Laptop')" :size="20" />
							</button>
							<button class="w-10 h-10 rounded-lg ml-2 flex justify-center items-center hover:text-blue-600 hover:bg-blue-200 transition-all text-slate-500 bg-slate-100">
								<component :is="icon('Laptop2')" :size="20" />
							</button>
							<button class="w-10 h-10 rounded-lg ml-2 flex justify-center items-center hover:text-blue-600 hover:bg-blue-200 transition-all text-slate-500 bg-slate-100">
								<component :is="icon('Tablet')" :size="20" />
							</button>
							<button class="w-10 h-10 rounded-lg ml-2 flex justify-center items-center hover:text-blue-600 hover:bg-blue-200 transition-all text-slate-500 bg-slate-100">
								<component :is="icon('Smartphone')" :size="20" class="rotate-90" />
							</button>
							<button class="w-10 h-10 rounded-lg ml-2 flex justify-center items-center hover:text-blue-600 hover:bg-blue-200 transition-all text-slate-500 bg-slate-100">
								<component :is="icon('Tablet')" :size="20" />
							</button>
						</div>
						<div class="flex ml-4">
							<button class="flex-auto mr-2 w-36 rounded-lg h-10 bg-slate-100 font-medium flex items-center justify-center"><component :is="icon('Layers')" :size="18" class="mr-2" /> Nawigator</button>
							<button class="flex-auto w-36 rounded-lg h-10 bg-slate-100 font-medium flex items-center justify-center"><component :is="icon('Code2')" :size="18" class="mr-2" /> Wyświetl kod</button>
						</div>
					</div>
				</div>
			</div>
			<div class="w-80 border-l flex items-center border-slate-300 px-4">
				<button class="flex-auto w-full rounded-lg h-10 bg-green-600 text-white font-medium flex items-center justify-center"><component :is="icon('Save')" :size="18" class="mr-2" /> Zapisz widok</button>
			</div>
		</header>
		<section class="visual-area-main flex h-full">
			<aside class="w-16 h-full visual-area-col-components py-8 flex-col justify-between flex z-50">
				<div class="bg-white rounded-full ml-4 shadow-md p-2 w-14">
					<VisualPanelElement iconName="BoxSelect" type="layout" />
					<VisualPanelElement class="mt-4" iconName="Baseline" type="basic" />
					<VisualPanelElement class="mt-4" iconName="FileText" type="basic" />
					<VisualPanelElement class="mt-4" iconName="FormInput" type="basic" />
					<VisualPanelElement class="mt-4" iconName="Image" type="basic" />
					<VisualPanelElement class="mt-4" iconName="PlusSquare" type="basic" />
				</div>

				<div class="bg-white rounded-full ml-4 shadow-md p-2 w-14 mt-4">
					<div class="relative w-10 h-10">
						<button class="h-10 w-10 flex justify-center items-center rounded-full hover:bg-blue-500 hover:text-white text-slate-500">
							<component :is="icon('Layers')" :size="24" />
						</button>
					</div>
					<div class="relative w-10 h-10 mt-4">
						<button class="h-10 w-10 flex justify-center items-center rounded-full hover:bg-blue-500 hover:text-white text-slate-500">
							<component :is="icon('Settings')" :size="24" />
						</button>
					</div>
					<div class="relative w-10 h-10 mt-4">
						<button class="h-10 w-10 flex justify-center items-center rounded-full text-green-500 hover:bg-green-500 hover:text-white transition-all">
							<component :is="icon('Save')" :size="24" />
						</button>
					</div>
					<div class="relative w-10 h-10 mt-4">
						<button class="h-10 w-10 flex justify-center items-center rounded-full hover:bg-blue-500 hover:text-white text-slate-500">
							<component :is="icon('ChevronLeft')" :size="24" />
						</button>
					</div>
				</div>
			</aside>

			<aside class="flex-auto h-full p-8">
				<div class="visual-area-builder h-full bg-white shadow-md">
					<VisualNested :children="content" class="visual-element h-full first" root />
				</div>
			</aside>

			<aside class="w-80 bg-white h-full border-l border-slate-300 visual-area-col-components">
				<VisualConfigurator />
				{{ content }}
                <Tree :value="content" label="name" key="uuid"></Tree>
			</aside>
		</section>
	</div>
</template>

<script>
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import Draggable from "vuedraggable";
import Tree from 'primevue/tree';
import VisualConfigurator from './Panel/Configurator.vue';
import VisualPanelElement from './Panel/Element.vue';
import * as icons from 'lucide-vue';
import Dropdown from '../Input/Dropdown.vue';

export default {
	components: {
        Accordion,
        AccordionTab,
		Draggable,
        Tree,
        VisualConfigurator,
		VisualPanelElement,
		Dropdown
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
	data() {
		return {
			breakpoint: 'xxl',
		}
	},
	methods: {
		icon(icon) {
			return icons[icon];
		},
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
