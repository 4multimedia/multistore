<template>
    <div class="intro-y box mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <div class="flex justify-between w-full">
                <h2 class="font-medium text-base mr-auto">{{ header }}</h2>
                <ChevronDown @click="onHandleOpen" :class="{'transform rotate-180' : open}" />
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
