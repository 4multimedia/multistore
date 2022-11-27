<template>
     <aside>
          <Blueprint component="button" class="btn btn-outline-dark">Paragraph
                         <template v-slot:blueprint><Paragraph /></template>
                    </Blueprint>
                    <Blueprint component="button" class="btn btn-outline-dark">
                         Nagłówek
                         <template v-slot:blueprint><Headline /></template>
                    </Blueprint>
           <Blueprint component="button" class="btn btn-outline-dark">
            Container
            <template v-slot:blueprint>
              <Canvas component="Container" />
            </template>
          </Blueprint>

          <Blueprint component="button" class="btn btn-outline-dark">
            Row
            <template v-slot:blueprint><Canvas component="Row" /></template>
          </Blueprint>

          <Blueprint component="button" class="btn btn-outline-dark">
            Kolumna
            <template v-slot:blueprint><Canvas component="Column" /></template>
          </Blueprint>

          <hr />
     </aside>
</template>

<script>
import Blueprint from './../Core/Blueprint.vue';
import Canvas from './../Core/Canvas.vue';
import Headline from './../Elements/Headline/Index.vue';

export default {
     components: {
          Blueprint,
          Canvas,
          Headline
     },
     inject: ['editor'],
     data() {
          return {
               elements: []
          }
     },
     mounted() {
          const group = this.editor.getGroup('Paragraph');
     }
}
</script>
