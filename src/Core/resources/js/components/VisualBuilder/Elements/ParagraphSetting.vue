<template>
  <div>
       <input class="form-control" v-model="content" />
     </div>
   </template>

   <script>
   import settingMixin from './../Mixins/settingMixin';

   export default {
     mixins: [settingMixin],
     computed: {
       content: {
         get() {
           return this.elementProps.content;
         },
         set(value) {
           this.updateContent(value);
         },
       },
     },
     methods: {
       updateContent(content) {
         this.elementPropsSetter({ content });
       },
     },
   };
   </script>
