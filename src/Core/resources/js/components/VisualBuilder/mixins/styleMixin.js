export const styleMixin = {
	inject:['components'],
	methods: {
        getSetting(key, def) {
			if (def === undefined) { def = ''; }
            if (this.element && this.element.setting && this.element.setting[key]) {
                return this.element.setting[key];
            }
            return def;
        }
    },
	/*watch: {
		'$store.state.layout.current.setting': {
			handler(newValue, oldValue) {
				console.log(this.$store.state.layout.current);
				for (const [index, value] of Object.entries(newValue)) {
					this.form[index] = value;
				}
			},
			deep: true
		}
	},
	data() {
		return {
			form: {},
		}
	},
	created() {
		const component = this.element.component;
		const components = this.components;
		const values = {};
		const defaults = this.element.setting;
		for (const [index_1, group] of Object.entries(components)) {
			for (const [index_2, element] of Object.entries(group.elements)) {
				if (element.component === component) {
					console.log(element.configuration.setting);
					for (const [index_3, settings] of Object.entries(element.configuration.setting)) {
						for (const [index_4, field] of Object.entries(settings)) {
							values[field.id] = defaults[field.id] === undefined ? '' : defaults[field.id];
						}
					}
					break;
				}
			}
		}
		const element = JSON.parse(JSON.stringify(this.$store.state.layout.current));
		element.setting = values;
	},*/
	computed: {
		minheight() {
            return this.getSetting('minheight');
        },
		height() {
            return this.getSetting('height');
        },
		width() {
            return this.getSetting('width');
        },
		backgroundColor() {
            return this.getSetting('background.color');
        },
		constraints() {
            return this.getSetting('constraints', {});
        },
		paddingTop() {
			if (this.constraints['padding.top']) {
				return this.constraints['padding.top'];
			} else {
				return 0;
			}
		},
		paddingBottom() {
			if (this.constraints['padding.bottom']) {
				return this.constraints['padding.bottom'];
			} else {
				return 0;
			}
		},
		paddingRight() {
			if (this.constraints['padding.right']) {
				return this.constraints['padding.right'];
			} else {
				return 0;
			}
		},
		paddingLeft() {
			if (this.constraints['padding.left']) {
				return this.constraints['padding.left'];
			} else {
				return 0;
			}
		},
		styles() {
			const array = [];
			console.log(this.paddingTop);
			if (this.height !== undefined && this.height != '') {
				array.push(`height:${this.height}px`);
			}
			if (this.minheight !== undefined && this.minheight != '') {
				array.push(`min-height:${this.minheight}px`);
			}
			if (this.width !== undefined && this.width != '') {
				array.push(`width:${this.width}px`);
			}
			if (this.backgroundColor !== undefined && this.backgroundColor != '') {
				array.push(`background-color:${this.backgroundColor}`);
			}
			if (this.paddingTop !== undefined && this.paddingTop != '') {
				array.push(`padding-top:${this.paddingTop}`);
			}
			if (this.paddingRight !== undefined && this.paddingRight != '') {
				array.push(`padding-right:${this.paddingRight}`);
			}
			if (this.paddingBottom !== undefined && this.paddingBottom != '') {
				array.push(`padding-bottom:${this.paddingBottom}`);
			}
			if (this.paddingLeft !== undefined && this.paddingLeft != '') {
				array.push(`padding-left:${this.paddingLeft}`);
			}
			return array.join("; ");
		}
	}
}
