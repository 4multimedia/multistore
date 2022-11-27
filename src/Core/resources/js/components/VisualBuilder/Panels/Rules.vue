<template>
     <div class="builder__rules">
          <div class="builder__rules__blank"></div>
          <div class="builder__rules__provide top"><Rule /></div>
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
