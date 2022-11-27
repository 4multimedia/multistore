<template>
    <ul>
        <li v-for="e, index in error" :key="index">{{ e }}</li>
    </ul>
</template>

<script>
    export default {
        props: {
            error: Array
        }
    }
</script>
