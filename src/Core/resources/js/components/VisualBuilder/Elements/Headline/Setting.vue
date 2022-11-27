<template>
     <div>
          <input class="form-control" v-model="content" />
          <select v-model="tag">
               <option value="h1">H1</option>
               <option value="h2">H2</option>
               <option value="h3">H3</option>
          </select>
      </div>
</template>

<script>
import settingMixin from './../../Mixins/settingMixin';

export default {
     mixins: [settingMixin],
     computed: {
          tag: {
               get() { return this.elementProps.tag },
               set(value) { this.updateContent('tag', value); },
          },
          content: {
               get() { return this.elementProps.content; },
               set(value) { this.updateContent('content', value); },
          },
     },
     methods: {
          updateContent(key, value) {
               this.elementPropsSetter({ [key]: value });
          },
     },
};
</script>
