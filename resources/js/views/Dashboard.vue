<template>
    <Smoothie class="content">
        <div class="container">
            <header-comp />

            {{ store.pagination }}
            <div class="space">
                <h1>
                    Посты на странице
                </h1>
            </div>
            <div class="space">
                <add-post />
            </div>
            <div class="space" ref="scrollBlock">
                <data-table
                    :posts="store.posts"
                />
            </div>
        </div>
    </Smoothie>

    <post-panel />
</template>

<script>
import 'boxicons/css/boxicons.min.css'
import { Smoothie } from 'vue-smoothie';
import { onMounted, onUnmounted, ref } from 'vue';
import HeaderComp from '../components/admin/HeaderComp.vue';
import DataTable from '../components/admin/DataTable.vue'
import PostPanel from '../components/admin/post/PostPanel.vue';
import AddPost from '../components/admin/post/AddPost.vue';
import { useDashboardStore } from '../store/dashboard';
import apiData from '../services/api.js';

export default {
    components: {
        DataTable,
        PostPanel,
        AddPost,
        Smoothie,
        HeaderComp
    },
    props: {
        posts: {
            type: Array,
            default: () => []
        }
    },
    setup(props) {
        const store = useDashboardStore();
        const content = ref(null);
        const scrollBlock = ref(null)

        onMounted(async () => {
            const scrollPosition = window.sessionStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
            }

            store.getPosts(await apiData.getData())
            content.value = document.querySelector('.content')
            content.value.addEventListener('scroll', scrollHandle)
        })

        onUnmounted (() => {
            content.value.removeEventListener('scroll', scrollHandle)
        })

        const scrollHandle = async () => {
            const blockRect = scrollBlock.value.getBoundingClientRect(); // получаем координаты блока
            const contentWindowHeight = content.value.offsetHeight; // получаем высоту окна блока прокрутки
            const bottomOffset = blockRect.bottom - contentWindowHeight - 300; // определяем расстояние от нижней границы блока до нижней границы окна
            if (bottomOffset <= 0) {
                if (store.pagination.currentPage < store.pagination.totalPages) {
                    const currentPage = Number(store.pagination.currentPage) + 1
                    const newPosts = await apiData.getData(currentPage)
                    store.getNewPosts(newPosts)
                }
            }
        }

        return {
            store,
            scrollBlock,
            scrollHandle,
        }
    },
}
</script>

<style scoped>
.content {
    width: 100%;
    height: 100vh;
}
</style>
