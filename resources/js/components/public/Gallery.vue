<template>
    <div class="gallery__wrapper" ref="scrollBlock" @scroll="scrollHandle">
        <div class="gallery" >
            <template v-for="(item, index) in posts" :key="item.showId">
            <article class="gallery__item">
                <div class="gallery__item__image">
                    <img :src="'/images/' + item.image" @load="onImageLoad" alt="">
                    <div class="gallery__item__stamp" v-if="item.suma && imageLoaded">
                        <stamp :suma="item.suma"/>
                    </div>
                </div>
                <div class="gallery__item__dascription" v-if="item.description">{{ item.description }}</div>
            </article>
            <div v-if="(index + 1) % 8 === 0" class="contact__form">
                <h4>Хотите также?<br>Оставляйте заявку!</h4>
                <form>
                    <input type="text" placeholder="Ваше имя">
                    <input type="text" placeholder="Ваш телефон">
                    <button type="submit" class="more__btn">Хочу также</button>
                </form>
            </div>
            </template>
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
            const bottomOffset = blockRect.bottom - contentWindowHeight - 600; // определяем расстояние от нижней границы блока до нижней границы окна
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
