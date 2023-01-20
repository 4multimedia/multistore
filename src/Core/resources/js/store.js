import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        layout: {
            content: [],
            current: {},
            hover: {}
        },
    },
	actions: {
		updateValue({ commit }) {
			console.log(commit);
		}
	},
    mutations: {
        setLayout(state, layout) {
            state.layout.content = layout;
        },
        setElement(state, element) {
            state.layout.current = element;
        },
        hoverElement(state, element) {
            state.layout.hover = element;
        },
		updateValueElement(state, item) {
			alert('commit');
			const element = state.layout.current;
			const setting = element.setting;
			setting[item.id] = item.value;
			element.setting = setting;
			state.layout.current = element;
		}
    }
});

export default store;
