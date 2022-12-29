<template>
	<div class="form-inline items-start flex-col xl:flex-row mt-3 pt-3 first:mt-0 first:pt-0">
		<div class="form-label xl:w-64 xl:!mr-10">
            <div class="text-left">
                <div class="flex items-center mt-2">
                    <div class="font-medium">{{ label }}</div> <span class="ml-2 text-red-700">*</span>
                </div>
                <div v-if="help" class="leading-relaxed text-slate-500 text-xs mt-3">{{ help }}</div>
            </div>
        </div>
		<div class="w-full mt-3 xl:mt-0 flex-1">
			<slot />
			<div v-if="max" class="form-help text-right">{{ count }}/{{ max }}</div>
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
			modelValue: [Number,String,Array,Object],
        }
    }
</script>
