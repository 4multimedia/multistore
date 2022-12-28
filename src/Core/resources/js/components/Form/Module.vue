<template>
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-2 hidden 2xl:block">
            <div class="sticky mt-5 top-0">
                <ul class="text-slate-500 relative before:content-[''] before:w-[2px] before:bg-slate-200 before:dark:bg-darkmode-600 before:h-full before:absolute before:right-0 before:z-[-1]">
                    <li
                        v-for="tab, index in tabs"
                        :key="index"
                        @click="changeTab(index)"
                        :class="`border-r-2 mb-4 transition pr-5 text-right cursor-pointer ${active === index ? 'border-primary dark:border-primary text-primary font-medium' : 'border-transparent dark:border-transparent'}`">
                            <span>{{ tab.header }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="intro-y col-span-11 2xl:col-span-9">
            <slot />
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                active: null,
                tabs: []
            }
        },
        methods: {
            changeTab(index) {
                this.active = index;

                this.tabs.forEach((tab, i) => {
                    tab.active = (index === i)
                });
            },
        },
        mounted() {
            this.tabs = this.$children;
            this.changeTab(0);
        },
    }
</script>
