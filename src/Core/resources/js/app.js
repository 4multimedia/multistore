import "./bootstrap";
import "./location";
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
import InputTextarea from './components/Input/InputTextarea.vue';
import InputPassword from './components/Input/InputPassword.vue';
import InputSwitch from './components/Input/InputSwitch.vue';
import Dropdown from './components/Input/Dropdown.vue';
import InputCheckbox from './components/Input/InputCheckbox.vue';
import VisualBuilder from './components/VisualBuilder/Index.vue';
import InputGallery from './components/Input/Gallery.vue';
import InputImage from './components/Input/InputImage.vue';
import InputTreeSelect from './components/Input/Treeselect.vue';
import SelectButton from './components/Input/SelectButton.vue';

import VisualComponent from './components/VisualBuilder/Components/Component';
import NavigationBuilder from './components/NavigationBuilder/Index.vue';

import ConfirmationService from 'primevue/confirmationservice';
import ConfirmDialog from 'primevue/confirmdialog';

//import Container from './components/VisualBuilder/Elements/Container';
//import Column from './components/VisualBuilder/Elements/Column/Index';
//import Headline from './components/VisualBuilder/Elements/Headline/Index';
//import Row from './components/VisualBuilder/Elements/Row/Index';

import VisualNested from './components/VisualBuilder/Components/Nested2.vue';
import UiSidebar from './components/Ui/Sidebar/Index';
import UiBox from './components/Ui/Box/Index';
import UiTip from './components/Ui/Tip/Index';
import Tooltip from 'primevue/tooltip';

import store from './store';

import FormBody from './components/Form/Body.vue';
import FormModule from './components/Form/Module.vue';
import FormSection from './components/Form/Section.vue';
import FormTree from './components/Form/Tree.vue';

import Button from 'primevue/button';
import Dialog from 'primevue/dialog';

import Media from './components/Media/Index.vue';
import DataTable from './components/Data/Index.vue';
import DataTree from './components/Data/Tree/Index.vue';
import DialogMedia from './components/Media/Dialog.vue';
import Message from 'primevue/message';

import ViewsLayoutColors from './components/Views/Layout/Colors.vue';

import components from "./visual";

import Draggable from "vuedraggable";

import pl from './../../../data/json/lang/pl.json';
import en from './../../../data/json/lang/en.json';

const translate = {
    pl,
    en
}

Vue.use(PrimeVue);
Vue.use(ConfirmationService);

Vue.component('InputText', InputText);
Vue.component('InputTextarea', InputTextarea);
Vue.component('InputPassword', InputPassword);
Vue.component('InputSwitch', InputSwitch);
Vue.component('InputImage', InputImage);
Vue.component('SelectButton', SelectButton);
Vue.component('FormBody', FormBody);
Vue.component('FormModule', FormModule);
Vue.component('FormSection', FormSection);
Vue.component('FormTree', FormTree);
Vue.component('VisualBuilder', VisualBuilder);
//Vue.component('Paragraph', Paragraph);
//Vue.component('Container', Container);
//Vue.component('Column', Column);
//Vue.component('Headline', Headline);
//Vue.component('Row', Row);
Vue.component('UiSidebar', UiSidebar);
Vue.component('UiBox', UiBox);
Vue.component('Media', Media);
Vue.component('Dialog', Dialog);
Vue.component('UiTip', UiTip);
Vue.component('Button', Button);
Vue.component('DataTable', DataTable);
Vue.component('DataTree', DataTree);
Vue.component('Dropdown', Dropdown);
Vue.component('InputCheckbox', InputCheckbox);
Vue.component('Message', Message);
Vue.component('InputGallery', InputGallery);
Vue.component('InputTreeSelect', InputTreeSelect);
Vue.component('DialogMedia', DialogMedia);
Vue.component('ViewsLayoutColors', ViewsLayoutColors);
Vue.component('VisualNested', VisualNested);
Vue.component('VisualComponent', VisualComponent);
Vue.component('NavigationBuilder', NavigationBuilder);
Vue.component('Draggable', Draggable);
Vue.directive('tooltip', Tooltip);
Vue.component('ConfirmDialog', ConfirmDialog);

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const lang = document.querySelector('meta[name="language"]').content;

const __t = (value) => {
    const [ group, key ] = value.split(".");
    return (translate[lang][group] !== undefined && translate[lang][group][key]) ? translate[lang][group][key] : key;
};

new Vue({
    provide: {
        __t,
        csrfToken,
        lang,
        translate,
		components
    },
    el: '#app',
    store,
});

/*app.$mount('#app')

app.component('InputText', InputText);


app.component('FormBody', FormBody);
app.mount('#app');*/
