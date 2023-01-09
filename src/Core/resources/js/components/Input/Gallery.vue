<template>
    <div>
        <button @click="onHandleOpenDialog">Wybierz zdjęcia</button>
        {{ dialog }}
        <dialog-media :display.sync="dialog" :limit="2" :allow="['jpg', 'jpeg', 'svg', 'png', 'gif']"></dialog-media>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dialog: false
        }
    },
    methods: {
        onHandleOpenDialog() {
            this.dialog = true;
        }
    }
}
</script>
