<template>
    <div class="box mt-5 first:mt-0">
        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400" :class="paddingHeader">
            <div class="flex items-center justify-between w-full">
                <h2 class="font-medium text-base mr-auto">{{ header }}</h2>
				<slot name="right">
					<ChevronDown @click="onHandleOpen" :class="{'transform rotate-180' : open}" />
				</slot>
            </div>
        </div>
        <div class="p-5" v-show="open">
            <slot />
        </div>
    </div>
</template>

<script>
import { ChevronDown } from 'lucide-vue';

export default {
    components: {
        ChevronDown
    },
    props: {
        header: String,
		paddingHeader: {
			type: String,
			default: 'p-5',
		},
        noTab: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            open: true
        }
    },
    methods: {
        onHandleOpen() {
            this.open = !this.open;
        }
    },
}
</script>
