// app.js

import {createApp} from 'vue'

import App from './components/App.vue'
const app = createApp({
    mounted() {
       console.log('The app is working')
    }
 });
 app.component('App', App);

createApp(App).mount("#app")