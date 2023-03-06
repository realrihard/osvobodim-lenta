<template>
    <div ref="container" class="grid">
      <div v-for="index in columns" :key="index" class="grid-sizer"></div>
      <div v-for="(item, index) in items" :key="index" class="grid-item">
        {{ item.content }}
      </div>
    </div>
  </template>

  <script>
  import Colcade from 'colcade';
  import { onMounted, ref, toRef } from 'vue';

  export default {
    name: "WaterfallGallery",
    props: {
        columns:{
            type: Number,
            default: 4
        }
    },
    setup(props) {
      const container = ref(null);
      const items = ref([
        { content: 'Item 1' },
        { content: 'Item 2' },
        { content: 'Item 3' },
        { content: 'Item 4' },
        { content: 'Item 5' },
      ]);

      onMounted(() => {
        const colcade = new Colcade(container.value, {
          columns: '.grid-sizer',
          items: '.grid-item',
        });
      });

      return { container, items };
    },
  };
  </script>

  <style>
  .grid-sizer {
    width: 25%;
  }
  .grid-item {
    width: 25%;
  }
  </style>
