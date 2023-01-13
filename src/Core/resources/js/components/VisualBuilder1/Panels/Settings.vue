<template>
     <div class="setting-panel">
       <div v-if="settings" class="settings">
         <component
           v-for="(component, name) in settings"
           :key="name"
           :is="component"
           :node="selectedNode"
         ></component>
       </div>

       <button class="btn btn-danger mt-3" v-if="selectedNode" @click="removeElement">Delete</button>

	   <button @click="onHandleExportObject">Eksportuj</button> {{ d }}
     </div>
   </template>

   <script>
	export default {
		inject: [
			'editor',
		],
		data() {
			return {
				d: '',
			}
		},
     computed: {
       selectedNode() {
         return this.editor.selectedNode;
       },
       settings() {
         if (!this.selectedNode) {
           return null;
         }

         return this.editor.getSettings(this.selectedNode);
       },
     },
     methods: {
		onHandleExportObject() {
			console.log(JSON.parse(this.editor.export()));
			this.d = JSON.parse(this.editor.export());
		},
    removeElement() {
      return this.editor.removeNode(this.selectedNode);
    },
  },
   };
   </script>
