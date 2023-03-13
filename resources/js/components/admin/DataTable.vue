<template>
        <draggable
            v-model="postsArray"
            group="posts"
            @start="drag=true"
            @end="drag=false"

            item-key="showId"
            class="dashboard__list"
        >
                <template #item="{element}">
                    <div class="dashboard__list__item" :class="element.deleted ? 'post__deleted' : ''">
                        <data-table-item :post="element"/>
                    </div>
                </template>
        </draggable>
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
                store.changePostsSort(newValue)
                apiData.updatePostOrder(newValue)
            }
        })

        return {
            store,
            drag,
            postsArray,
        }
    },
})
</script>
