<template>
    <div v-if="component">
        <TabView>
            <TabPanel v-for="tab, index in tabs" :key="index" :header="tab.name">
                <Accordion>
                    <AccordionTab v-for="setting, index_tab in tab.configuration" :key="index_tab" :header="index_tab">
                        <div v-for="field, index in setting" :key="index">
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
            </TabPanel>
        </TabView>
    </div>
</template>

<script>
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        Accordion,
        AccordionTab,
        TabView,
        TabPanel
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
            for (const [index, tabs] of Object.entries(setting)) {
                for (const [tab, fields] of Object.entries(tabs)) {
                    for (const [index, field] of Object.entries(fields)) {
                        for (const [key, value] of Object.entries(field)) {
                            if (value.id === undefined) {
                                this.form = {...this.form, ...{[value.id]: ''}};
                            }
                        }

                    }
                    array.push({name: tab, configuration: fields});
                }
            }
            return array;
        },
    }
}
</script>
