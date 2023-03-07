<template>
    <button class="service__btn btn_danger" @click="deletePost">
        <i class='bx bx-trash'></i>
    </button>
</template>

<script>
import apiData from '../../../services/api'
import { useDashboardStore } from '../../../store/dashboard.js'

export default {
    props: {
        postId: {
            type: Number,
            default: null
        }
    },
    setup(props) {
        const store = useDashboardStore();

        const deletePost = () => {
            store.deletePost(props.postId)
            apiData.deletePost(props.postId)
        }
        return {
            store,
            deletePost
        }
    },
}
</script>
