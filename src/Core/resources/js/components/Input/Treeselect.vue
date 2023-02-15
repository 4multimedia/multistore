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
            async loadOptions() {
                const request = await axios.get(this.url);
                const { data } = request;

                this.options = data;
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
