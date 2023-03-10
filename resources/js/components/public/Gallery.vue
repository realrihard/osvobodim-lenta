<template>
    <div class="gallery__wrapper" ref="scrollBlock" @scroll="scrollHandle">
        <div class="gallery" >
            <article class="gallery__item" v-for="item in posts" :key="item.showId">
                <div class="gallery__item__image">
                    <img :src="'/images/' + item.image" @load="onImageLoad" alt="">
                    <div class="gallery__item__stamp" v-if="item.suma && imageLoaded">
                        <stamp :suma="item.suma"/>
                    </div>
                </div>
                <div class="gallery__item__dascription" v-if="item.description">{{ item.description }}</div>
            </article>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { ref, onMounted, onUnmounted } from 'vue'
import Stamp from './Stamp.vue'

export default {
    components: {
        Stamp,
    },
    setup() {
        const scrollBlock = ref(null)
        const posts = ref(null)
        const currentPage = ref(1)
        const pages = ref(null)
        const imageLoaded = ref(false)
        const content = ref(null)

        onMounted (async() => {
            await axios.get('/posts')
            .then(response => {
                posts.value = response.data.posts
                pages.value = response.data.pagination.totalPages
            })
            content.value = document.querySelector('.content')
            content.value.addEventListener('scroll', scrollHandle)
        })

        onUnmounted (() => {
            content.value.removeEventListener('scroll', scrollHandle)
        })

        const getPosts = async () => {
            currentPage.value++
            const data = await axios.get('/posts?page=' + currentPage.value)
            return data.data.posts
        };

        const getNewPosts = async () => {
            let newPosts = await getPosts(currentPage.value)
            posts.value.push(...newPosts)
        }

        const onImageLoad = () => {
            imageLoaded.value = true
        }

        const scrollHandle = () => {
            //const content = document.querySelector('.content')
            //const smoothBlock = content.querySelector('div').firstElementChild
            //const smoothBlockRect = smoothBlock.getBoundingClientRect()
            const blockRect = scrollBlock.value.getBoundingClientRect(); // получаем координаты блока
            const contentWindowHeight = content.value.offsetHeight; // получаем высоту окна блока прокрутки
            const bottomOffset = blockRect.bottom - contentWindowHeight - 500; // определяем расстояние от нижней границы блока до нижней границы окна
            if (bottomOffset <= 0) {
                if (currentPage.value <= pages.value) {
                    getNewPosts()
                }
            }
        }

        return {
            scrollBlock,
            posts,
            currentPage,
            getPosts,
            imageLoaded,
            onImageLoad,
            scrollHandle,
        }
    },
}
</script>

<style lang="scss" scoped>
.gallery {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;

    &__wrapper {
        width: 100%;
        max-width: 470px;
        margin: 0 auto;
        padding: 0 15px;
    }

    &__item {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding-bottom: 20px;
        border-bottom: solid 1px #dbdbdb;

        &__image {
            position: relative;
            width: 100%;
            img {
                width: 100%;
            }
        }

        &__stamp {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
}
</style>
