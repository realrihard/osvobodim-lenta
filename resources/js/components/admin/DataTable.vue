<template>
        <draggable
            v-model="postsArray"
            group="posts"
            @start="drag=true"
            @end="drag=false"

            item-key="showId"
            class="dashboard__list"
        >
                <template #item="{element, index}">
                    <div class="dashboard__list__item" :class="element.deleted ? 'post__deleted' : ''">
                        <data-table-item :post="element"/>
                    </div>
                </template>
        </draggable>
</template>

<script>
import { defineComponent, computed, ref, onMounted, onUnmounted } from 'vue';
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
                store.getPosts(newValue)
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

<style lang="scss" scoped>
.dashboard__list {
    width: 100%;
    list-style: none;
    padding: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 364px));
    gap: 3rem;

    &__item {
        aspect-ratio: auto 1 / 1;
        overflow: hidden;
        border-radius: 1rem;
    }
}
.post__deleted {
    transform: scale(0);
    transform-origin-x: left;
    transform-origin-y: top;
    animation: scale-down 0.5s forwards;
}
@keyframes scale-down {
    from {
      transform: scale(1);
      opacity: 1;
    }
    to {
      transform: scale(0);
      opacity: 0;
    }
}
</style>
