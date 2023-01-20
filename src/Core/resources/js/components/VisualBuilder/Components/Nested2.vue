<template>
	<draggable
        tag="section"
        :list="children"
		:group="group"
        :options="{ group: { pull: false, put: true }, ghostClass: 'visual-ghost' }"
        @add="onAdd"
        handle=".handle"
    >
		<div v-for="el, index in children" :key="index" :id="el.uuid" class="visual-node">
			<component :is="el.component" :makeid="makeid" :element="el"></component>
		</div>
	</draggable>
</template>

<script>
import Draggable from "vuedraggable";

export default {
	components: {
		Draggable,
	},
	props: {
		children: {
			required: true,
      		type: Array
		},
        onAddItem: Function,
		clone: {
			type: [Boolean, Function, String],
			default: true
		},
		put: {
			type: [Boolean, Function, String],
			default: true
		},
		group: {
			type: String,
			default: 'visualComponents',
		},
        root: {
            type: Boolean,
            default: false
        }
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
			const index = item.newIndex;
            var path = item.originalEvent.path || (item.originalEvent.composedPath && item.originalEvent.composedPath());

            let tree = [];
            path.forEach(e => {
                if (e && e.className !== undefined && typeof(e.className) === 'string' && e.className.search("visual-node") > -1) {
                    const id = e.id;
                    tree.push(id);
                }
            });

            tree.reverse(tree);

            const data = item.item.id.split(".");
            let element = this.components[data[0]].elements.find(e => e.component === data[1]);
            element = JSON.parse(JSON.stringify(element));

			const elements = element.configuration;
            const setting = element.configuration.default;

            const cloneElement = {
                name: element.name,
                component: element.component,
                children: element.children,
                uuid: this.makeid(8),
				nested: element.nested,
                accepted: element.accepted,
                setting: setting
            };

			this.addToTree(tree, cloneElement, index);
        },
		addToTree(tree, cloneElement, index) {
            const layout = this.$store.state.layout.content;
            if (tree.length === 0) {
                layout.push(cloneElement);
            } else {
                let node = layout;
                for(let a = 0; a < tree.length; a++) {
                    const cloneNode = node.find(e => e.uuid == tree[a]);
                    node = cloneNode.children;
                    if (a == tree.length - 1) {
						if (cloneNode.nested) {
							node.splice(index, 0, cloneElement);
                            break;
                            return;
						}
						else {
							tree.pop();
							this.addToTree(tree, cloneElement, index);
						}
                    }
                }
            }

            this.$store.commit('setLayout', layout);
		}
    },
}
</script>
