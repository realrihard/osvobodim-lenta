<template>
    <div class="gallery">
      <div class="gallery-item" v-for="(image, index) in images" :key="index" @click="openModal(image)">
        <img :src="getThumbnail(image)" />
      </div>
      <div class="modal" v-if="modalOpen">
        <div class="modal-content">
          <img :src="modalImage" />
          <button class="modal-close" @click="closeModal">×</button>
        </div>
      </div>
    </div>
  </template>

  <script>
  import { onMounted, ref} from 'vue';
  import axios from 'axios';

  export default {
    props: {
      thumbnailSize: {
        type: Number,
        default: 250
      }
    },
    setup(props) {
        const images = ref([]);
        const modalOpen = ref(false);
        const modalImage = ref('');

        onMounted(async () => {
        await axios.get('/api/posts')
        .then((resp) => {
            resp.data.data.forEach(element => {
                images.value.push('/images/' + element.image)
            });
        })
      })

      function openModal(image) {
        modalImage.value = image;
        modalOpen.value = true;
      }

      function closeModal() {
        modalOpen.value = false;
      }

      const getThumbnail = (image) => {
        if (image.width > image.height) {
          return `${image}?width=${props.thumbnailSize}`;
        } else {
          return `${image}?height=${props.thumbnailSize}`;
        }
      }

      return {
        images,
        modalOpen,
        modalImage,
        openModal,
        closeModal,
        getThumbnail
      }
    }
  }
  </script>

  <style>
  .gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    grid-gap: 20px;
  }

  .gallery-item {
    position: relative;
    overflow: hidden;
    padding: 0;
  }

  .gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center center;
  }

  .modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .modal-content {
    position: relative;
    width: 80%;
    max-width: 800px;
    height: 80%;
    max-height: 800px;
    overflow: hidden;
    padding: 20px;
    box-sizing: border-box;
  }

  .modal img {
    max-width: 100%;
    max-height: 100%;
  }

  .modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 30px;
    color: #fff;
    background-color: transparent;
    border: none;
    cursor: pointer;
  }
  </style>
