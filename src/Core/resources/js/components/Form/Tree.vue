<template>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-r -mb-10 pb-10">
                <div class="2xl:pr-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8">
                        <data-tree :url="url" :update="update" root="" @updateForm="updateForm"></data-tree>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-9">
            <div class="mt-6">
                <form-body title="Edytuj kategorię"  language>
                    {{ form }}
                    <slot />

                    <template #buttons>
                        <div class="text-right mt-5">
                            <button type="button" class="btn bg-red-700 text-white w-40 mr-2">Usuń kategorię</button>
                            <button type="button" class="btn btn-primary w-40" @click="onHandleSaveForm">Zapisz zmiany</button>
                        </div>
                    </template>
                </form-body>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            this.findFormElements(this.$children);
        },
        props: {
            url: String,
            update: String
        },
        methods: {
            updateForm(form) {
                if (form['dictionary'] !== undefined) {
                    var array = [];
                    this.items.forEach(e => {
                        if (e.data.name.substr(0, 10) === 'dictionary') {
                            this.setValueElement(e.data.name, false);
                        }
                    })
                    for (const [key, value] of Object.entries(form.dictionary)) {
                        for (const [subkey, subvalue] of Object.entries(value)) {
                            this.setValueElement(`dictionary[${subvalue}]`, true);
                            array.push(subvalue);
                        }
                    }
                    this.form.dictionary = array;
                }
                for (const [key, value] of Object.entries(form.category)) {
                    this.setValueElement(key, value);
                    if (this.form[key] !== undefined) {
                        this.form[key] = value;
                    }
                }
            },
            findFormElements(children) {
                children.forEach(el => {
                    const tag = el.$options._componentTag;

                    if (this.fields.includes(tag)) {
                        const props = el.$options._propsKeys;
                        const data = el.$options.propsData;
                        let name = data.name;
                        let value = data.value;

                        if (data.name !== undefined) {
                            this.items.push({ tag, props, data, element: el });
                            const regex = /([a-zA-Z0-9-_]+)\[([a-zA-Z0-9-_]+)\]/i;
                            if(name.search(regex) > -1) {
                                const params = name.match(regex);
                                const key = isNaN(parseInt(params[2])) ? params[2] : parseInt(params[2]);
                                name = params[1];

                                if (this.form[name] === undefined) {
                                    this.form = {...this.form, ...{[name]: []}};
                                }

                                if (value) {
                                    this.form[name].push(key);
                                }

                                el.onChecked = (value) => {
                                    const index = this.form[name].findIndex(e => e == key);
                                    if (value) {
                                        if (index < 0) {
                                            this.form[name].push(key);
                                        }
                                    } else {
                                        if (index > -1) {
                                            this.form[name].splice(index, 1);
                                        }
                                    }
                                }
                            } else {
                                el.onChange = (value) => {
                                    this.form[name] = value;
                                }
                                this.form = {...this.form, ...{[name]: value}};
                            }
                        }
                    }
                    this.findFormElements(el.$children);
                });
            },
            setValueElement(name, value) {
                const element = this.items.find(e => e.data.name === name);
                if (element !== undefined) {
                    element.element.value = value;
                }
            },
            async onHandleSaveForm() {
                const href = window.location.href;
                await axios.put(href, this.form);
            }
        },
        data() {
            return {
                fields: [
                    'dropdown',
                    'input-text',
                    'InputText',
                    'PrimeInputText',
                    'input-checkbox'
                ],
                form: {},
                items: []
            }
        }
    }
</script>
