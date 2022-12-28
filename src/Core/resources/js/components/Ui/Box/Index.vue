<template>
    <div class="intro-y box p-5 mt-5">
        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
            <div class="font-medium text-base flex items-center" :class="{'pb-5 border-b border-slate-200/60 dark:border-darkmode-400': open}">
                <div class="flex justify-between items-center w-full">
                    <span>{{ header }}</span>
                    <ChevronDown @click="onHandleOpen" :class="{'transform rotate-180' : open}" class="w-4 h-4 cursor-pointer" />
                </div>
            </div>
            <div class="mt-5" v-show="open">
                <slot />
            </div>
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
        header: String
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
