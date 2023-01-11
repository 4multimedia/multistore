<template>
	<div class="intro-y items-start mt-3 pt-3 first:mt-0 first:pt-0" :class="{'form-inline flex-col xl:flex-row' : !column, 'has-error' : error.length > 0}">
		<div class="form-label xl:w-64 xl:!mr-10" :class="{'mb-2': column}" v-if="label">
            <div class="text-left">
                <div class="flex items-center" :class="{'mt-2': !column}">
                    <div class="font-medium">{{ label }}</div> <span v-if="required" class="ml-2 text-red-700">*</span>
                </div>
                <div v-if="help" class="leading-relaxed text-slate-500 text-xs mt-2">{{ help }}</div>
            </div>
        </div>
		<div class="w-full mt-2 xl:mt-0 flex-1">
			<slot />
			<div v-if="max" class="form-help text-right">{{ count }}/{{ max }}</div>
            <InputError :error="error" />
		</div>
	</div>
</template>

<script>
	import InputError from './InputError.vue';

    export default {
		components: {
			InputError,
		},
		computed: {
			count() {
				return this.modelValue.length
			}
		},
        props: {
            label: String,
			help: String,
			max: Number,
            error: {
                type: Array,
                default: () => []
            },
			modelValue: [Number,String,Array,Object],
            column: {
                type: Boolean,
                default: false
            },
			required: {
				type: Boolean,
				default: false
			}
        }
    }
</script>
