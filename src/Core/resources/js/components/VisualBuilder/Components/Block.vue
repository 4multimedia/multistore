<template>
    <visual-component :element="element" :style="styles" class="block">
        <div>
            <VisualNested :children="element.children" />
        </div>
    </visual-component>
</template>

<script>
import { background, constraints, height } from './../Configuration/index';
import { styleMixin } from './../mixins/styleMixin';

export default {
	props: {
		element: Object,
	},
	mixins: [styleMixin],
	element: {
        setting: Object.assign(height, background, constraints),
        default: {
            minheight: '30'
        }
    }
}
</script>
