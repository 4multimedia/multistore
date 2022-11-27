<template>
     <Editor component='div' :resolverMap="resolverMap">
          <div class="container-fluis">
               <div class="d-flex">
                    <div class="col">
                         <PanelElements />
                         <PanelSettings />
                    </div>
                    <div class="col-10">
                         <PanelRules>
                              <Frame component="div" class="preview-panel">
                                   <Canvas component="Container"></Canvas>
                              </Frame>
                         </PanelRules>
                    </div>
               </div>
          </div>
     </Editor>
</template>

<script>
import Canvas from './Core/Canvas.vue';
import Frame from './Core/Frame.vue';
import Editor from './Core/Editor.vue';
import PanelSettings from './Panels/Settings.vue';
import PanelElements from './Panels/Elements.vue';
import PanelRules from './Panels/Rules.vue';

import Container from './Elements/Container.vue';
import Column from './Elements/Column/Index.vue';
import Headline from './Elements/Headline/Index.vue';
import Paragraph from './Elements/Paragraph.vue';
import Row from './Elements/Row/Index.vue';

export default {
     components: {
          Canvas,
          Editor,
          Frame,
          Headline,
          PanelElements,
          PanelRules,
          PanelSettings
     },
     data() {
          return {
               resolverMap: {
                    Canvas,
                    Column,
                    Row,
                    Paragraph,
                    Headline,
                    Container
               }
          }
     }
}
</script>
