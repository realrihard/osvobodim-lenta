import './bootstrap';

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import Dashboard from './views/Dashboard.vue'

const dashboard = createApp(Dashboard)

dashboard.use(createPinia())
dashboard.mount('#app')

