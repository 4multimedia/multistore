<template>
    <div v-if="component">
		<div class="h-10 flex items-center px-3 text-xs">
			<span class="text-slate-600 inline-flex items-center mx-1 px-2 h-5 rounded bg-slate-200">p</span>
			<span class="text-slate-600 inline-flex items-center mx-1 px-2 h-5 rounded bg-slate-200">span.text</span>
		</div>
        <Accordion>
            <AccordionTab v-for="setting, index_tab in tabs" :key="index_tab" :header="setting.name">
                <div v-for="field, index in setting.configuration" :key="index">
                    <component
                        :is="field.field"
                        v-bind="{
                            label: field.name,
                            options: field.options,
                            value: form[field.id]
                        }"
                        v-model="form[field.id]"
                        @onChangeValue="onChangeValue($event, field.id)"
                    />
                </div>
            </AccordionTab>
        </Accordion>
    </div>
</template>

<script>
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import VisualConstraints from './../Block/Constraints.vue';

export default {
    components: {
        Accordion,
        AccordionTab,
        TabView,
        TabPanel,
		VisualConstraints
    },
    inject: ['components'],
    data() {
        return {
            form: {}
        }
    },
    methods: {
        onChangeValue(value, id) {
			this.form[id] = value;
        }
    },
	watch: {
		'form': {
			handler(value) {
				this.$store.state.layout.current.setting = value;
			},
			deep: true
		}
	},
    computed: {
        element() {
            return this.$store.state.layout.current;
        },
        component() {
            return this.element.component;
        },
        configuration() {
            if (this.component) {
                for (const [group, modules] of Object.entries(this.components)) {
                    for (const [module, configuration] of Object.entries(modules.elements)) {
                        if (configuration.component === this.component) {
                            return configuration.configuration;
                        }
                    }
                }
            }
            return [];
        },
        tabs() {
            const array = [];
            const setting = this.configuration.setting;
            this.form = this.$store.state.layout.current.setting;

			for (const [index_1, elements] of Object.entries(setting)) {
				for (const [index_2, field] of Object.entries(elements)) {
					if (this.form[field.id] === undefined) {
						let value = '';
						if (field.type === 'object') {
							value = {};
						}
						this.form = {...this.form, ...{[field.id]: value}};
					}
				}
				array.push({name: index_1, configuration: elements});
			}

            return array;
        },
    }
}
</script>
