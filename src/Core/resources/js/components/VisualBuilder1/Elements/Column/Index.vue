<template>
     <div class="col">
          <div class="col-content">
               <slot />
          </div>
     </div>
</template>

<style lang="scss" scoped>
.col-content {
     border:1px dashed #ccc;
     padding:5px;
}
</style>

<script>
     export default {
          element: {
               addition: {
                    parent: ['Row']
               }
          },
     };
</script>