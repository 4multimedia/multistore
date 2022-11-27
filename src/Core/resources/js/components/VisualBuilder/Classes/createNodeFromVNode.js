import cloneDeep from 'lodash/cloneDeep';
import Node from './Node';

function getElementConfig(componentName, props, editor) {
	const config = {
		defaultProps: {},
		rules: {},
		addition: {},
	};

	let resolver;

	if (componentName === 'Canvas') {
		resolver = editor.findResolver(props.component);
	} else {
		resolver = editor.findResolver(componentName);
	}

	if (resolver.element) {
		Object.keys(config).forEach((key) => {
			if (resolver.element[key]) {
   				config[key] = cloneDeep(resolver.element[key]);
			}
		});
	}

	return config;
}

function createNodeFromVNode(editor, vnode, parentNode = null) {
	console.log(vnode);
  if (!vnode.componentOptions) {
    return null;
  }

  const componentName = vnode.componentOptions.tag;
  let props = vnode.componentOptions.propsData;

  if (componentName === 'Canvas' && vnode.data.attrs) {
    props = { ...props, ...vnode.data.attrs };
  }

  const { rules, addition, defaultProps } = getElementConfig(componentName, props, editor);
  const nodeProps = { ...defaultProps, ...props };

  const node = new Node(componentName, nodeProps, parentNode, [], rules, addition);

  const vnodeChildren = vnode.componentOptions.children;
  const children = vnodeChildren
    ? vnodeChildren.map((childVNode) => createNodeFromVNode(editor, childVNode, node))
      .filter((childNode) => !!childNode)
    : [];
  node.children = children;

  return node;
}

export default createNodeFromVNode;
