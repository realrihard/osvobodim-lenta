<template>
    <div class="add__btn__wrapper">
        <i class='bx bx-plus add__btn' @click="addPost"></i>
    </div>
</template>

<script>
import { useDashboardStore } from '../../../store/dashboard.js';

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
