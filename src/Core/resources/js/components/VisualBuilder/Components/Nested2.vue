<template>
	<draggable
        tag="section"
        :list="children"
        group="visualComponents"
        :options="{ group:{ name:'visualComponents',  pull:'clone', put: false }, ghostClass: 'visual-ghost' }"
        @add="onAdd"
        handle=".handle"
    >
		<div v-for="el, index in children" :key="index" :id="el.uuid" class="visual-node">
			<component :is="el.component" :element="el">
                <span class="handle">handle</span>
            </component>
		</div>
	</draggable>
</template>

<script>
import Draggable from "vuedraggable";

export default {
	components: {
		Draggable
	},
	props: {
		children: {
			required: true,
      		type: Array
		},
        onAddItem: Function
	},
    root: {
        type: Boolean,
        default: false
    },
    inject: ['components'],
    methods: {
        makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        },
        onAdd(item) {
            const path = item.path;
            let tree = [];
            path.forEach(e => {
                if (e && e.className !== undefined && e.className.search("visual-node") > -1) {
                    const id = e.id;
                    tree.push(id);
                }
            });

            tree.reverse(tree);

            const data = item.item.id.split(".");
            let element = this.components[data[0]].elements.find(e => e.component === data[1]);
            element = JSON.parse(JSON.stringify(element));

            const setting = element.configuration.default;

            const cloneElement = {
                name: element.name,
                component: element.component,
                children: element.children,
                uuid: this.makeid(8),
                setting: setting
            };

            const layout = this.$store.state.layout.content;
            if (tree.length === 0) {
                layout.push(cloneElement);
            } else {
                let node = layout;
                for(let a = 0; a < tree.length; a++) {
                    node = node.find(e => e.uuid == tree[a]);
                    node = node.children;
                    if (a == tree.length - 1) {
                        node.push(cloneElement);
                    }
                }
            }

            this.$store.commit('setLayout', layout);
        }
    },
}
</script>
