<template>
    <div @click="onHandleSelectElement($event)" class="visual-element" :class="{'visual-select-element': selectElement === element.uuid}">
        <span class="handle"><Move size="14" /></span>
        <div class="actions">
            <span class="duplicate"><Files size="14" /></span>
            <span class="remove"><Trash2 size="14" /></span>
        </div>
        <slot />
    </div>
</template>

<script>
import { Move, Files, Trash2 } from 'lucide-vue';
export default {
    props: {
        element: {
            type: Object,
            required: true
        }
    },
    components: {
    Move,
    Files,
    Trash2
},
    computed: {
        selectElement() {
            console.log
            if (this.$store.state.layout.current && this.$store.state.layout.current.uuid !== undefined) {
                return this.$store.state.layout.current.uuid;
            }
            return null;
        }
    },
    methods: {
        onHandleSelectElement(event) {
            this.$store.commit('setElement', this.element);
            event.preventDefault();
            event.stopPropagation();
        }
    }
}
</script>
