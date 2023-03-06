<template>
    <div class="add__btn__wrapper">
        <button class="btn" @click="addPost">Добавить пост</button>
    </div>
</template>

<script>
import { useDashboardStore } from '../../store/dashboard.js';

export default {
    setup() {
        const store = useDashboardStore();

        const addPost = () => {
            store.getPanelSettings(true, 'Добавить запись', 'add')
        }

        return {
            store,
            addPost
        }
    },
}
</script>

<style lang="scss" scoped>
.add__btn__wrapper {
    max-width: 300px;
    justify-self: center;
}
</style>
