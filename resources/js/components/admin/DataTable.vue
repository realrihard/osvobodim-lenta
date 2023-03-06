<template>
        <ul class="dashboard__list" @editPost="editPostPanel">
            <li v-for="post in posts" :key="post" :class="post.deleted ? 'post__deleted' : ''">
                <data-table-item
                    :post="post"
                />
            </li>
        </ul>
</template>

<script>
import { defineComponent } from 'vue';
import DataTableItem from './DataTableItem.vue';

export default defineComponent ({
    components: {
        DataTableItem,
    },
    props: {
        posts: {
            type: Array,
        }
    },
    setup(props) {
        return {
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

    li {
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
