<template>
    <div class="container" style="padding: 50px 0">
        <h3 class="gallery__title">Наши выигранные дела</h3>
        <div class="gallery">
            <template v-for="(post, index) in posts" :key="post">
                <gallery-post :post="post" @post-loaded="onPostLoaded" />
                <contact-form v-if="(index + 1) % 8 === 0" />
            </template>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, toRef, onMounted} from 'vue';
import GalleryPost from './GalleryPost.vue';
import ContactForm from './ContactForm.vue';

    export default {
        name: 'gallery',
        components: {
            GalleryPost,
            ContactForm
        },
        props: {
            scrollOptions: {
                type: Object,
            }
        },
        setup(props, context) {
            const posts = ref([])
            const page = ref(1)
            const totalPages = ref(null)
            const postsLoaded = ref(0)
            const loading = ref(false)

            onMounted(async() => {
                await getPosts()
                await props.scrollOptions.on('scroll', async (obj) => {
                    console.log()
                    if (!loading.value && obj.delta.y === obj.limit.y && page.value <= totalPages.value) {
                        loading.value = true
                        await getPosts()
                        await onPostLoaded()
                        loading.value = false
                    }
                })
            })

            const getPosts = async() => {
                await axios.get('/posts/show?page=' + page.value, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(resp => {
                    posts.value = [...posts.value, ...resp.data.posts]
                    totalPages.value = resp.data.pagination.totalPages
                    page.value++
                })
                .catch(error => {
                    console.log(error);
                })
            }

            const onPostLoaded = async () => {
                postsLoaded.value++
                if (postsLoaded.value === (posts.value.length - 1)) {
                    context.emit('content-update')
                }
            }

            return {
                posts,
                page,
                totalPages,
                postsLoaded,
                loading,
                getPosts,
                onPostLoaded,
            }
        }
    }
</script>
