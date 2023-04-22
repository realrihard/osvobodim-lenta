<template>
            <!--<div class="dashboard__list__item" :class="element.deleted ? 'post__deleted' : ''">-->
            <div class="dashboard__list">
                <div class="dashboard__list__item" v-for="post in posts" :key="post">
                    <data-table-item :post="post"/>
                </div>
            </div>

            <!--</div>-->
</template>

<script>
import { defineComponent, computed, ref} from 'vue';
import DataTableItem from './DataTableItem.vue';
import draggable from 'vuedraggable'
import { useDashboardStore } from '../../store/dashboard';
import apiData from '../../services/api';

export default defineComponent ({
    components: {
        DataTableItem,
        draggable,
    },
    props: {
        posts: {
            type: Array,
        }
    },
    setup(props) {
        const store = useDashboardStore();
        const drag = ref(false);

        const postsArray = computed({
            get: () => store.posts,
            set: async (newValue) => {
                newValue.forEach((obj, index) => {
                    obj.showId = index;
                });
                //store.changePostsSort(newValue)
                //apiData.updatePostOrder(newValue)
            }
        })

        const dragChange = (element) => {
            const indexes = [element.oldIndex, element.newIndex]

            const firstPostIndex = store.posts.findIndex(post => post.showId === element.oldIndex)
            const secondPostIndex = store.posts.findIndex(post => post.showId === element.newIndex)

            const posts = [...store.posts]
            const firstShowId = posts[firstPostIndex]['showId']
            const secondShowId = posts[secondPostIndex]['showId']

            posts[firstPostIndex]['showId'] = secondShowId
            posts[secondPostIndex]['showId'] = firstShowId

            store.refreshPost(posts)
            apiData.updatePostOrder(posts)
        }

        return {
            store,
            drag,
            //postsArray,
            dragChange
        }
    },
})
</script>
