<template>
     <p>{{ content }}</p>
   </template>
   
   <script>
   import ParagraphSetting from './ParagraphSetting.vue';
   
   export default {
     props: {
       content: String,
     },
     element: {
       defaultProps: {
         content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
       },
       settings: {
         ParagraphSetting,
       },
     },
   };
   </script>