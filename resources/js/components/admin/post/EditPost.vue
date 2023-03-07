<template>
    <button class="service__btn btn_primary" @click="editPost">
        <i class='bx bx-edit'></i>
    </button>
</template>

<script>
import { useDashboardStore } from '../../../store/dashboard'

export default {
    props: {
        post: {
            type: Object,
            default: null
        }
    },
    setup(props) {
        const store = useDashboardStore();

        const editPost = () => {
            store.getPanelSettings(true, 'Изменить запись', 'edit')
            store.getEditedPost(props.post)
        }

        return {
            store,
            editPost
        }
    },
}
</script>
