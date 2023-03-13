import './bootstrap';

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { Smoothie } from 'vue-smoothie';
import PostPanel from './../js/components/admin/post/PostPAnel.vue'
import Dashboard from './views/Dashboard.vue'

const dashboard = createApp({})

dashboard.use(createPinia())
dashboard.component('Smoothie', Smoothie)
dashboard.component('dashboard', Dashboard)
dashboard.component('post-panel', PostPanel)

dashboard.mount('#app')

