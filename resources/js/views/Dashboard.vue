<template>
        <div class="container">
            {{ store.posts }}
            <div class="space">
                <add-post />
            </div>
            <div class="space" ref="scrollBlock">
                <data-table
                    :posts="store.posts"
                />
            </div>
        </div>
</template>

<script>
import 'boxicons/css/boxicons.min.css'
import { onMounted, onUnmounted, ref } from 'vue';
import DataTable from '../components/admin/DataTable.vue'
import AddPost from '../components/admin/post/AddPost.vue';
import { useDashboardStore } from '../store/dashboard';
import apiData from '../services/api.js';

export default {
    components: {
        DataTable,
        AddPost,
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
        const loadedPages = ref([1])

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
            if (bottomOffset <= 0 && !loadedPages.value.includes(store.pagination.currentPage)) {
                if (store.pagination.currentPage < store.pagination.totalPages && !loadedPages.value.includes(store.pagination.currentPage)) {
                    const currentPage = Number(store.pagination.currentPage) + 1
                    const newPosts = await apiData.getData(currentPage)
                    store.getNewPosts(newPosts)
                    loadedPages.value.push(store.pagination.currentPage)
                }
            }
        }

        return {
            store,
            loadedPages,
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
