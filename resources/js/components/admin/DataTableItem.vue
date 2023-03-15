<template>
        <div class="item__box" @click="toggleSettings(post)">
            <div class="item__image" :style="{ backgroundImage: 'url(images/thumb/' + post.image + ')'}">
            </div>
            <div class="item__settings" v-if="post.showSettings">
                <div class="item__settings__buttons">
                    <edit-post :post="post"/>
                    <delete-post :postId="post.id"/>
                </div>
            </div>
        </div>
</template>

<script>
import { ref } from 'vue';
import EditPost from './post/EditPost.vue';
import DeletePost from './post/DeletePost.vue';
import { useDashboardStore } from '../../../js/store/dashboard.js'


export default {
    components: {
        EditPost,
        DeletePost,
    },
    props: {
        post: {
            type: Object
        }
    },
    setup() {
        const store = useDashboardStore();
        const image = ref(null)
        const previewSize = ref({
            width: 0,
            height: 0
        })
        const showSettings = ref(false)

        const toggleSettings = (post) => {
            showSettings.value = !showSettings.value;
            store.showPostSettings(post)
        }

        return {
            store,
            image,
            previewSize,
            showSettings,
            toggleSettings
        }
    },
}
</script>
