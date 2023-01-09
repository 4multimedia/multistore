<template>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-r -mb-10 pb-10">
                <div class="2xl:pr-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8">
                        <data-tree url="" root=""></data-tree>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-9">
            <div class="mt-6">
                <form-body>
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
    export default {
        mounted() {
            this.findFormElements(this.$children);
        },
        methods: {
            findFormElements(children) {
                children.forEach(el => {
                    const tag = el.$options._componentTag;

                    if (this.fields.includes(tag)) {
                        const props = el.$options._propsKeys;
                        const data = el.$options.propsData;
                        const name = data.name;

                        el.onChange = (value) => {
                            this.form[name] = value;
                        }

                        this.items.push({ tag, props, data, element: el });
                        this.form = {...this.form, ...{[name]: ''}};
                    }
                    this.findFormElements(el.$children);
                });
            },
            setValueElement(name, value) {
                const element = this.items.find(e => e.data.name === name);
                element.element.value = value;
            },
            onHandleSaveForm() {
                console.log(this.form);
            }
        },
        data() {
            return {
                fields: [
                    'dropdown',
                    'input-text',
                    'InputText',
                ],
                form: {},
                items: []
            }
        }
    }
</script>
