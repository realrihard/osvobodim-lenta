<template>
    <div class="space">
        <h1>
            Посты на странице
        </h1>
    </div>
    <div class="space">
        <add-post />
    </div>
    <div class="space">
        <data-table
            :posts="store.posts"
        />
    </div>

    <post-panel>
        <add-form v-if="store.panelSettings.type == 'add'" />
        <edit-form v-if="store.panelSettings.type == 'edit'" />
    </post-panel>
</template>

<script>
import 'boxicons/css/boxicons.min.css'
import axios from 'axios';
import { onMounted, ref } from 'vue';
import DataTable from '../components/admin/DataTable.vue'
import PostPanel from '../components/admin/post/PostPanel.vue';
import AddPost from '../components/admin/post/AddPost.vue';
import AddForm from '../components/admin/post/forms/AddForm.vue';
import EditForm from '../components/admin/post/forms/EditForm.vue';
import { useDashboardStore } from '../store/dashboard';
import apiData from '../services/api.js';

export default {
    components: {
        DataTable,
        PostPanel,
        AddPost,
        AddForm,
        EditForm
    },
    props: {
        posts: {
            type: Array,
            default: () => []
        }
    },
    setup(props) {
        const store = useDashboardStore();
        const posts = ref([]);

        onMounted(async () => {
            store.getPosts(await apiData.getData())
        })

        return {
            store,
            posts,
        }
    },
}
</script>
