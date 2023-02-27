<!-- Vue SFC -->
<template>
    <InputField :label="label" :required="required" :help="help" :error="error" :modelValue="modelValue" :column="column">
        <input type="hidden" :name="name" :value="id" />
        <treeselect
            v-model="modelValue"
            :multiple="multiple"
            :normalizer="normalizer"
            :options="options"
            :load-options="loadOptions"
            :auto-load-root-options="false"
            @select="onSelect"
            placeholder="Wybierz"
        />
    </InputField>
  </template>

<script>
    import axios from 'axios';
    import InputField from './InputField.vue';
    import Treeselect from '@riophae/vue-treeselect';

    export default {
        components: {
            InputField,
            Treeselect
        },
        props: {
            name: String,
            label: String,
            required: {
                type: Boolean,
                default: false
            },
            help: String,
            error: Array,
            multiple: {
                type: Boolean,
                default: false
            },
            column: {
                type: Boolean,
                default: false
            },
            url: String
        },
        methods: {
            onSelect(node) {
                if (!this.multiple) {
                    this.id = node.id;
                }
            },
            async loadOptions({action, parentNode, callback }) {

                let id_parent = null;
                if (parentNode !== undefined) {
                    id_parent = parentNode.id;
                }

                const request = await axios.get(`${this.url}&id_parent=${id_parent}`);
                const { data } = request;

                if (parentNode === undefined) {
                    this.options = data;
                } else {
                    parentNode.children = data;
                }
            }
        },
        data() {
            return {
                id: null,
                modelValue: null,
                normalizer(node) {
                    return {
                        label: node.text,
                    }
                },
                options: null,
            }
        },
    }
</script>
