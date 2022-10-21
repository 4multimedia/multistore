import { createApp } from 'vue';

import InputText from './components/Input/InputText.vue';
import InputPassword from './components/Input/InputPassword.vue';

import FormBody from './components/Form/Body.vue';

const app = createApp({});

app.component('InputText', InputText);
app.component('InputPassword', InputPassword);

app.component('FormBody', FormBody);
app.mount('#app');
