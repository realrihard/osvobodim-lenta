<template>
    <div class="overflow">
        <div class="panel">
            <div class="panel__header">
                <div class="panel__title">
                    <h3>{{ store.panelSettings.title }}</h3>
                </div>
                <button class="close__btn" @click="closePanel"><i class='bx bx-x bx_red'></i></button>
            </div>
            <div class="panel__content">
                <add-form v-if="store.panelSettings.type == 'add'" />
                <edit-form v-if="store.panelSettings.type == 'edit'"/>
            </div>
        </div>
    </div>
</template>

<script>import AddForm from './forms/AddForm.vue';
import EditForm from './forms/EditForm.vue';
import { useDashboardStore } from '../../../store/dashboard';
import { computed } from 'vue';

export default {
    components: {
        AddForm,
        EditForm
    },
    setup() {
        const store = useDashboardStore();

        const showPanel = computed(() => {
            return store.panelSettings.visible
        })

        const closePanel = () => {
            store.getPanelSettings(false, null, null)
            store.getEditedPost(null)
        }

        return {
            store,
            showPanel,
            closePanel
        };
    }
}
</script>
