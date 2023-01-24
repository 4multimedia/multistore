<template>
	<div class="visual-constraints">
		<div>
			<span class="visual-constraints-label margin">Margines</span>

			<input type="text" @input="onChange($event, 'margin.top')" :value="modelValue['margin.top']" class="mt" />
			<input type="text" @input="onChange($event, 'margin.right')" :value="modelValue['margin.right']" class="mr" />
			<input type="text" @input="onChange($event, 'margin.bottom')" :value="modelValue['margin.bottom']" class="mb" />
			<input type="text" @input="onChange($event, 'margin.left')" :value="modelValue['margin.left']" class="ml" />


			<div class="visual-constraints-boxpadding">
				<span class="visual-constraints-point top"></span>
				<span class="visual-constraints-point right"></span>
				<span class="visual-constraints-point bottom"></span>
				<span class="visual-constraints-point left"></span>
				<input type="text" @input="onChange($event, 'padding.top')" :value="modelValue['padding.top']" class="pt" />
				<input type="text" @input="onChange($event, 'padding.right')" :value="modelValue['padding.right']" class="pr" />
				<input type="text" @input="onChange($event, 'padding.bottom')" :value="modelValue['padding.bottom']" class="pb" />
				<input type="text" @input="onChange($event, 'padding.left')" :value="modelValue['padding.left']" class="pl" />
				<span class="padding visual-constraints-label">Odstęp</span>
			</div>
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
				'margin.top': 0,
				'margin.right': 0,
				'margin.bottom': 0,
				'margin.left': 0,
			}
        }
    }
}
</script>
