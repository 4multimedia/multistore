<template>
	<InputField :label="label" :required="required" :help="help" :error="error" :max="max" :modelValue="modelValue" :column="column">
		<template v-if="!translate">
			<PrimeTextarea class="form-control" :help="help" :name="name" v-model="modelValue" :placeholder="getplaceholder" :maxlength="max" @input="onChange($event)" />
		</template>
		<template v-else v-for="language in languages" :key="language.code">
			<PrimeTextarea v-show="language.code == currentLang" class="form-control" :help="help" :name="`${name}[${language['code']}]`" v-model="modelValue[language.code]" :placeholder="getplaceholder" :maxlength="max" @input="onChange($event)" />
		</template>
	</InputField>
</template>

<script>
import InputField from './InputField.vue';
import PrimeTextarea from 'primevue/textarea';
import input from './../../mixin/input';

export default {
    components: {
        InputField,
        PrimeTextarea,
    },
	mixins:[input],
    props: {
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
    methods: {
        onChange(value) {
            this.$emit('onChangeValue', value);
            this.$emit('update:value', value)
        }
    },
}
</script>
