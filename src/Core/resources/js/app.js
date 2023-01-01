import "./bootstrap";
import "@left4code/tw-starter/dist/js/svg-loader";
import "@left4code/tw-starter/dist/js/accordion";
import "@left4code/tw-starter/dist/js/alert";
import "@left4code/tw-starter/dist/js/dropdown";
import "@left4code/tw-starter/dist/js/modal";
import "@left4code/tw-starter/dist/js/tab";

/*
 |--------------------------------------------------------------------------
 | 3rd Party Libraries
 |--------------------------------------------------------------------------
 |
 | Import 3rd party library JS files.
 |
 */

import "./chart";
import "./highlight";
import "./lucide";
import "./tiny-slider";
import "./tippy";
import "./datepicker";
import "./tom-select";
import "./dropzone";
import "./validation";
import "./zoom";
import "./notification";


/*
 |--------------------------------------------------------------------------
 | Custom Components
 |--------------------------------------------------------------------------
 |
 | Import JS custom components.
 |
 */

import './side-menu';

/*
 |--------------------------------------------------------------------------
 | Vue Components
 |--------------------------------------------------------------------------
 |
 | Import Vue Component files.
 |
 */

import Vue from 'vue';
import PrimeVue from 'primevue/config';
import InputText from './components/Input/InputText.vue';
import InputPassword from './components/Input/InputPassword.vue';
import VisualBuilder from './components/VisualBuilder/Index.vue';

import Paragraph from './components/VisualBuilder/Elements/Paragraph';
import Container from './components/VisualBuilder/Elements/Container';
import Column from './components/VisualBuilder/Elements/Column/Index';
import Headline from './components/VisualBuilder/Elements/Headline/Index';
import Row from './components/VisualBuilder/Elements/Row/Index';
import UiSidebar from './components/Ui/Sidebar/Index';
import UiBox from './components/Ui/Box/Index';
import UiTip from './components/Ui/Tip/Index';

import FormBody from './components/Form/Body.vue';
import FormModule from './components/Form/Module.vue';
import FormSection from './components/Form/Section.vue';

import Button from 'primevue/button';
import Dialog from 'primevue/dialog';

import Media from './components/Media/Index.vue';

Vue.use(PrimeVue);

Vue.component('InputText', InputText);
Vue.component('InputPassword', InputPassword);
Vue.component('FormBody', FormBody);
Vue.component('FormModule', FormModule);
Vue.component('FormSection', FormSection);
Vue.component('VisualBuilder', VisualBuilder);
Vue.component('Paragraph', Paragraph);
Vue.component('Container', Container);
Vue.component('Column', Column);
Vue.component('Headline', Headline);
Vue.component('Row', Row);
Vue.component('UiSidebar', UiSidebar);
Vue.component('UiBox', UiBox);
Vue.component('Media', Media);
Vue.component('Dialog', Dialog);
Vue.component('UiTip', UiTip);
Vue.component('Button', Button);

new Vue({
    el: '#app',
});

/*app.$mount('#app')

app.component('InputText', InputText);


app.component('FormBody', FormBody);
app.mount('#app');*/
