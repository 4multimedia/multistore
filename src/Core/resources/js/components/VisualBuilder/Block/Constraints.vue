<template>
	<div>
		<div>
			<pre>{{ modelValue }}</pre>
			<input type="text" @input="onChange($event, 'padding.top')" :value="modelValue['padding.top']" />
			<input type="text" @input="onChange($event, 'padding.right')" :value="modelValue['padding.right']" />
			<input type="text" @input="onChange($event, 'padding.bottom')" :value="modelValue['padding.bottom']" />
			<input type="text" @input="onChange($event, 'padding.left')" :value="modelValue['padding.left']" />
		</div>
	</div>
</template>

<script>
export default {
	mounted() {
        //this.modelValue = this.value;
    },
	props: {
		value: Object
	},
	methods: {
		onChange(e, type) {
			this.modelValue[type] = e.target.value;

			this.$emit('onChangeValue', this.modelValue);
            this.$emit('update:value', this.modelValue);
		}
    },
    watch: {
        value() {
            //this.modelValue = this.value;
        }
    },
	data() {
        return {
            modelValue: {
				'padding.top': 0,
				'padding.right': 0,
				'padding.bottom': 0,
				'padding.left': 0,
			}
        }
    }
}
</script>
