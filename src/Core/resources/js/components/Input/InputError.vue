<template>
    <ul>
        <li v-for="e, index in error" :key="index">{{ e }}</li>
    </ul>
</template>

<script setup>
defineProps({
    error: Array
})
</script>
