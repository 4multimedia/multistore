<template>
    <div v-show="active">
        <slot />
    </div>
</template>

<script>
    export default {
        props: {
            header: String,
            active: Boolean
        }
    }
</script>
