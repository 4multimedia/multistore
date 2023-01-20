<template>
    <component :is="tag"
        @click="onHandleSelectElement($event)"
        @mouseenter="onHandleHoverElement($event)"
        @mouseleave="onHandleHoverReset($event)"
        class="visual-element"
        :class="{
            'visual-hover-element': hoverElement === element.uuid,
            'visual-select-element': selectElement === element.uuid,
        }
        ">
        <span class="handle"><Move :size="14" /></span>
        <div class="actions">
            <span class="duplicate" @click="cloneElement"><Files :size="14" /></span>
            <span class="remove"><Trash2 :size="14" /></span>
        </div>
        <slot />
    </component>
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
        tag() {
            if (this.element && this.element.setting && this.element.setting.tag) {
                return this.element.setting.tag;
            }
            return 'div';
        },
        selectElement() {
            if (this.$store.state.layout.current && this.$store.state.layout.current.uuid !== undefined) {
                return this.$store.state.layout.current.uuid;
            }
            return null;
        },
        hoverElement() {
            if (this.$store.state.layout.hover && this.$store.state.layout.hover.uuid !== undefined) {
                return this.$store.state.layout.hover.uuid;
            }
            return null;
        }
    },
    methods: {
		findPath(ob, key, value) {
			const path = [];
			const keyExists = (obj) => {
				if (!obj || (typeof obj !== "object" && !Array.isArray(obj))) {
					return false;
				}
				else if (obj.hasOwnProperty(key) && obj[key] === value) {
					return true;
				}
				else if (Array.isArray(obj)) {
					let parentKey = path.length ? path.pop() : "";
					for (let i = 0; i < obj.length; i++) {
						path.push(`${parentKey}[${i}]`);
						const result = keyExists(obj[i], key);
						if (result) {
							return result;
						}
						path.pop();
					}
				} else {
					for (const k in obj) {
 						path.push(k);
						const result = keyExists(obj[k], key);
						if (result) {
							return result;
						}
						path.pop();
					}
				}
				return false;
			};

			keyExists(ob);
			return path.join(".");
		},
		cloneElement() {
			let element = this.$store.state.layout.current;
			let layout = this.$store.state.layout.content;
			const uuid = element.uuid;

			element = JSON.parse(JSON.stringify(element));
		},
        onHandleSelectElement(event) {
            this.$store.commit('setElement', this.element);
            event.preventDefault();
            event.stopPropagation();
        },
        onHandleHoverElement(event) {
            this.$store.commit('hoverElement', this.element);
            event.preventDefault();
            event.stopPropagation();
        },
        onHandleHoverReset(event) {
            this.$store.commit('hoverElement', {});
            event.preventDefault();
            event.stopPropagation();
        }
    }
}
</script>
