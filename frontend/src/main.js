// import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'
import VueCookies from 'vue-cookies'


const app = createApp(App);
app.use(VueCookies);
app.use(router)
app.mount('#app')
