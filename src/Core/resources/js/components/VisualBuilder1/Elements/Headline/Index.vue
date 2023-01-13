<template>
     <component :is="tag">{{ content}}</component>
</template>

<script>
import Setting from './Setting.vue';

export default {
     props: {
          tag: String,
          content: String
     },
     element: {
          defaultProps: {
               tag: 'h1',
               content: 'Nagłówek',
          },
          settings: {
               Setting,
          },
          group: 'layout'
     }
}
</script>