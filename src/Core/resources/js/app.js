import Vue from 'vue'

import InputText from './components/Input/InputText.vue';
import InputPassword from './components/Input/InputPassword.vue';
import VisualBuilder from './components/VisualBuilder/Index.vue';

import Paragraph from './components/VisualBuilder/Elements/Paragraph';
import Container from './components/VisualBuilder/Elements/Container';
import Column from './components/VisualBuilder/Elements/Column/Index';
import Headline from './components/VisualBuilder/Elements/Headline/Index';
import Row from './components/VisualBuilder/Elements/Row/Index';

import FormBody from './components/Form/Body.vue';

Vue.component('InputText', InputText);
Vue.component('InputPassword', InputPassword);
Vue.component('FormBody', FormBody);
Vue.component('VisualBuilder', VisualBuilder);
Vue.component('Paragraph', Paragraph);
Vue.component('Container', Container);
Vue.component('Column', Column);
Vue.component('Headline', Headline);
Vue.component('Row', Row);

new Vue({
    el: '#app',
});

/*app.$mount('#app')

app.component('InputText', InputText);


app.component('FormBody', FormBody);
app.mount('#app');*/
