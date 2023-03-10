const input = {
	props: {
        translate: {
            type: Boolean,
            default: false
        },
	},
	mounted() {
		this.modelValue = this.value;
		this.languages = window.languages;
        if (this.translate) {
            if (typeof(this.modelValue) == 'string') {
				let parse = {};
				if (this.modelValue != '') {
                	parse = JSON.parse(this.modelValue);
				}
                let array = {};
                this.languages.forEach(e => {
                    array[e.code] = parse[e.code] !== undefined ? parse[e.code] : (e.default ? this.value : '');
                });
                this.modelValue = array;
            } else {
                this.languages.forEach(e => {
                    if (this.modelValue[e.code] === undefined) {
                        this.modelValue[e.code] = '';
                    }
                });
            }
        }
	},
	inject: ['editLang'],
	computed: {
        currentLang() {
            return this.editLang.lang;
        },
		getplaceholder() {
			if (this.placeholder) {
				return this.placeholder;
			} else if (this.label) {
				return this.label;
			} else {
				return null;
			}
		}
	},
	watch: {
        value() {
            this.modelValue = this.value;
        }
    },
    data() {
        return {
			languages: [],
            modelValue: ''
        }
    }
}

export default input;
