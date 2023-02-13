<template>
	<InputField :label="label" :help="help" :error="error" :modelValue="modelValue" :column="column">
		<input type="text" :name="name" />
		<treeselect v-model="modelValue" :multiple="multiple" :options="options" />
	</InputField>
</template>

<script>
import InputField from './InputField.vue';
import Treeselect from '@riophae/vue-treeselect';
import '@riophae/vue-treeselect/dist/vue-treeselect.css'

export default {
    components: {
        InputField,
		Treeselect
    },
    props: {
        label: String,
        value: [Number, String],
		help: String,
        name: String,
        error: Array,
        options: Array,
        column: {
            type: Boolean,
            default: false
        },
		multiple: {
			type: Boolean,
			default: false
		}
    },
	data() {
		return {
			modelValue: null,
			options: [ {
          id: 'a',
          label: 'a',
          children: [ {
            id: 'aa',
            label: 'aa',
          }, {
            id: 'ab',
            label: 'ab',
          } ],
        }, {
          id: 'b',
          label: 'b',
        }, {
          id: 'c',
          label: 'c',
        } ],
		}
	}
}
</script>
