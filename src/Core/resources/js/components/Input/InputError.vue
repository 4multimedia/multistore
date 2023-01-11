<template>
    <ul class="mt-2" v-if="error">
        <li class="text-xs text-red-600" v-for="e, index in error" :key="index">{{ e }}</li>
    </ul>
</template>

<script>
    export default {
        props: {
            error: Array
        }
    }
</script>
