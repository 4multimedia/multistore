<template>
	<InputField :label="label" :required="required" :help="help" :error="error" :max="max" :modelValue="modelValue" :column="column">
		<template v-if="!translate">
			<editor api-key="81t84o2dldjx59qp6sa2i95kmdrjnt8ectntop38icrg1x6o" :init="editor" :name="name" v-model="modelValue"></editor>
		</template>
		<template v-else v-for="language in languages" :key="language.code">
			<div v-show="language.code == currentLang">
				<editor api-key="81t84o2dldjx59qp6sa2i95kmdrjnt8ectntop38icrg1x6o" :init="editor" :name="`${name}[${language['code']}]`" v-model="modelValue[language.code]"></editor>
			</div>
		</template>
	</InputField>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
import InputField from './InputField.vue';
import input from './../../mixin/input';

export default {
    components: {
        InputField,
		Editor
    },
	mixins:[input],
	data() {
		return {
			editor: {
				height: 500,
				menubar: false,
				plugins: [
				'advlist autolink lists link image charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table paste code help wordcount'
				],
				toolbar:
				'undo redo | formatselect | bold italic backcolor | \
				alignleft aligncenter alignright alignjustify | \
				bullist numlist outdent indent | removeformat | help'
			}
		}
	},
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
}
</script>
