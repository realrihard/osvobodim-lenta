<template>
        <div class="item__box">
            <div class="item__image" :style="{ backgroundImage: 'url(/images/thumb/' + post.image + ')'}">
            </div>
            <div class="item__settings">
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

        return {
            store,
            image,
            previewSize,
        }
    },
}
</script>

<style lang="scss" scoped>
.item {
    &__box {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        min-width: 364px;
        margin-bottom: 2rem;

        &:hover,
        &:focus,
        &:active {
            .item__settings {
                opacity: 1;
            }
        }
    }
    &__image {
        width: 100%;
        aspect-ratio: auto 1 / 1;
        background-size: cover;
        background-position: center;
    }
    &__settings {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(256,256,256,0.6);
        opacity: 0;
        transition: opacity .5s ease-in-out;
        &__buttons {
            display: flex;
            gap: 10px;
        }
    }
}
</style>
