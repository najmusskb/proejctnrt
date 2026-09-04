import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';
import LoadingSpinner from './components/LoadingSpinner.vue';

const app = createApp(App);
const pinia = createPinia();

app.use(pinia);
app.use(router);
app.component('LoadingSpinner', LoadingSpinner);

app.mount('#app');
