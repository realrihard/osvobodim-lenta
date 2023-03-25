<template>
    <article class="gallery__post" data-scroll>
        <div class="gallery__post__image">
            <img :src="'/images/' + post.image" @load="onImageLoad" alt="">
            <div class="gallery__post__stamp" v-if="post.suma && imageLoaded">
                <stamp :suma="post.suma"/>
            </div>
        </div>
        <div class="gallery__post__dascription" v-if="post.description">{{ post.description }}</div>
    </article>
</template>

<script>
import Stamp from './Stamp.vue'
import { ref } from 'vue'

    export default {
        name: 'gallery-post',
        components: {
            Stamp
        },
        props: {
            post: {
                type: Object,
                default: null
            }
        },
        setup(props, context) {
            const imageLoaded = ref(false)

            const onImageLoad = (value) => {
                context.emit('post-loaded')
                imageLoaded.value = true
            }
            return {
                imageLoaded,
                onImageLoad
            }
        }
    }
</script>
