import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        layout: {
            content: [],
            current: {}
        },
    },
    mutations: {
        setLayout(state, layout) {
            state.layout.content = layout;
        },
        setElement(state, element) {
            state.layout.current = element;
        }
    }
});

export default store;
