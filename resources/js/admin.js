import './bootstrap';

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import PostPanel from './../js/components/admin/post/PostPanel.vue'
import Dashboard from './views/Dashboard.vue'

const dashboard = createApp(Dashboard)

dashboard.use(createPinia())
dashboard.component('dashboard', Dashboard)
dashboard.component('post-panel', PostPanel)

dashboard.mount('#dashboard')

