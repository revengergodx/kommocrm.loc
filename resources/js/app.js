
import * as bootstrap from './bootstrap'
import App from './App.vue'
import { createApp } from 'vue'
import router from "./router"

createApp(App)
    .use(router)
    .use(bootstrap)
    .mount('#app')
