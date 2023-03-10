<template>
    <transition name="slide-up">
        <div class="panel" v-if="store.panelSettings.visible">
            {{ store.editedPost }}
            <div class="panel__header">
                <div class="panel__title">
                    <h3>{{ store.panelSettings.title }}</h3>
                </div>
                <button class="close__btn" @click="closePanel">x</button>
            </div>
            <div class="panel__content">
                <add-form v-if="store.panelSettings.type == 'add'" />
                <edit-form v-if="store.panelSettings.type == 'edit'"/>
            </div>
        </div>
    </transition>
</template>

<script>import AddForm from './forms/AddForm.vue';
import EditForm from './forms/EditForm.vue';
import { useDashboardStore } from '../../../store/dashboard';

export default {
    components: {
        AddForm,
        EditForm
    },
    setup() {
        const store = useDashboardStore();

        const closePanel = () => {
            store.getPanelSettings(false, null, null)
            store.getEditedPost(null)
        }

        return {
            store,
            closePanel
        };
    }
}
</script>

<style lang='scss' scoped>
.panel {
    position: fixed;
    bottom: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100vh;
    background-color: #fff;
    border: solid 1px #dbdbdb;
    overflow-y: auto;

    &__header {
        position: relative;
        display: flex;
        justify-content: center;
        padding: 4rem 3rem;

        h3 {
            margin: 0;
        }
        .close__btn {
            position: absolute;
            right: 2vw;
            top: 2vh;
        }
    }
    &__content {
        padding: 4rem 3rem;
    }
}
.slide-up-enter-active,
.slide-up-leave-active {
    transition: all 0.3s ease;
    transform: translateY(0);
}

.slide-up-enter,
.slide-up-leave-to {
    transition: all 0.3s ease;
    transform: translateY(100%);
}
</style>
