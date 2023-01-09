<template>
     <div class="visualbuilder-rules-rule">
          <div v-for="a in count" :key="a" :style="`width:${space}px; min-width:${space}px; flex:${space}px;`">
               <span v-if="a > 1">{{ (a-1) * space }}</span>
          </div>
     </div>
</template>

<script>
export default {
     data() {
          return {
               width: 1500,
               space: 50
          }
     },
     computed: {
          count() {
               return parseInt(this.width / this.space);
          }
     }
}
</script>
