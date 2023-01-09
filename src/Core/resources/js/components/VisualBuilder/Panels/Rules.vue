<template>
     <div class="visualbuilder-rules">
        <div class="visualbuilder-rules-blank"></div>
        <div class="visualbuilder-rules-provide top">
			<Rule style="flex:auto" />
			<Rule class="visualbuilder-rules-general" style="flex:0 0 1240px;" />
			<Rule style="flex:auto" />
		</div>
        <div></div>
        <div>
            <slot />
        </div>
     </div>
</template>

<script>
import Rule from './../Core/Rule.vue';

export default {
     components: {
          Rule
     }
}
</script>
