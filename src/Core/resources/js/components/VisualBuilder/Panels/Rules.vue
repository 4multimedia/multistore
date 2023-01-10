<template>
	<div>
    	<div class="visualbuilder-rules" @mousemove="onHandleCrosshair">

			<div class="visualbuilder-crosshair visualbuilder-crosshair-x" v-show="y > 32" :style="`top:${y}px`"></div>
			<div class="visualbuilder-crosshair visualbuilder-crosshair-y" v-show="x > 32" :style="`left:${x}px`"></div>

        	<div class="visualbuilder-rules-blank"></div>
        	<div class="visualbuilder-rules-provide top">
				<Rule style="flex:auto" class="visualbuilder-rules-reverse" />
				<Rule class="visualbuilder-rules-general" :style="`flex:0 0 ${sizeRule}px;`" />
				<Rule style="flex:auto" />
			</div>
        	<div class="visualbuilder-rules-provide left">
				<Rule class="visualbuilder-rules-general" style="flex:1;" />
			</div>
        	<div class="visualbuilder-area">
            	<div :style="`width:${sizeFrame}`">
					<slot />
				</div>
        	</div>
    	</div>
	</div>
</template>

<script>
import Rule from './../Core/Rule.vue';

export default {
	props: {
		breakpoint: Object
	},
    components: {
        Rule
    },
	methods: {
		onHandleCrosshair(e) {
			console.log(e);
			this.x = e.layerX - 1;
			this.y = e.layerY - 1;
		}
	},
	data() {
		return {
			x:0,
			y:0
		}
	},
	computed: {
		sizeFrame() {
			if (this.breakpoint.full) {
				return '100%;';
			} else {
				return this.breakpoint.size;
			}
		},
		sizeRule() {
			return this.breakpoint.size;
		}
	}
}
</script>
