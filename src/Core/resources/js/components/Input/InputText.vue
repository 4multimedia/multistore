<template>
	<InputField :label="label" :required="required" :help="help" :error="error" :max="max" :modelValue="modelValue" :column="column">
        <template v-if="!translate">
            <PrimeInputText class="form-control" :help="help" :name="name" v-model="modelValue" :placeholder="getplaceholder" :maxlength="max" @input="onChange($event)" />
        </template>
		<template v-else v-for="language in languages" :key="language.code">
			<PrimeInputText v-show="language.code == currentLang" class="form-control" :help="help" :name="`${name}[${language['code']}]`" v-model="modelValue[language.code]" :placeholder="getplaceholder" :maxlength="max" @input="onChange($event)" />
		</template>
	</InputField>
</template>

<script>
import InputField from './InputField.vue';
import PrimeInputText from 'primevue/inputtext';
import { getPrototypeOf } from '@swc/helpers';

export default {
    components: {
        InputField,
        PrimeInputText,
    },
    inject: ['editLang'],
    props: {
        translate: {
            type: Boolean,
            default: false
        },
        label: String,
		placeholder: String,
        value: String,
		help: String,
        name: String,
        error: Array,
		max: Number,
        column: {
            type: Boolean,
            default: false
        },
        required: {
            type: Boolean,
            default: false
        }
    },
    mounted() {
        this.modelValue = this.value;
		this.languages = window.languages;
        if (this.translate) {
            if (typeof(this.modelValue) == 'string') {
                let parse = JSON.parse(this.modelValue);
                if (typeof(parse) == 'string') {
                    parse = {};
                }
                let array = {};
                this.languages.forEach(e => {
                    array[e.code] = parse[e.code] !== undefined ? parse[e.code] : (e.default ? this.value : '');
                });
                this.modelValue = array;
            } else {
                this.languages.forEach(e => {
                    if (this.modelValue[e.code] === undefined) {
                        this.modelValue[e.code] = '';
                    }
                });
            }
        }
    },
	computed: {
        currentLang() {
            return this.editLang.lang;
        },
		getplaceholder() {
			if (this.placeholder) {
				return this.placeholder;
			} else if (this.label) {
				return this.label;
			} else {
				return null;
			}
		}
	},
    methods: {
        onChange(value) {
            this.$emit('onChangeValue', value);
            this.$emit('update:value', value)
        }
    },
    watch: {
        value() {
            this.modelValue = this.value;
        }
    },
    data() {
        return {
			languages: [],
            modelValue: ''
        }
    }
}
</script>
