<template>
	<form method="post">
		<input type="hidden" name="_token" v-model="token" />
        <div v-if="title || language" class="intro-y flex flex-col sm:flex-row items-center justify-between mt-8">
        	<h2 class="text-lg font-medium mr-auto" v-if="title">{{ title }}</h2><div v-else></div>
        	<div class="w-full sm:w-auto flex mt-4 sm:mt-0" v-if="language">
            	<div class="dropdown mr-2">
                	<button class="dropdown-toggle btn box flex items-center" aria-expanded="false" type="button" data-tw-toggle="dropdown">
                        <span :class="`fi fi-${current_language['flag']} mr-2`"></span>
                        <span>{{ current_language['name'] }}</span>
                        <ChevronDown class="w-4 h-4 ml-2" />
                	</button>
					<div class="dropdown-menu w-40">
						<ul class="dropdown-content">
							<li v-for="language in languages" :key="language.code">
								<span @click.stop="setLanguage(language['code'])" class="dropdown-item">
									<span :class="`fi fi-${language['flag']} mr-2`"></span>
									<span class="truncate">{{ language['name'] }}</span>
								</span>
							</li>
						</ul>
					</div>
            	</div>
                <ButtonAction></ButtonAction>
        	</div>
    	</div>
		<slot />
		<slot name="buttons">
			<button type="submit">ZAPISZ</button>
		</slot>
	</form>
</template>

<script>
import ButtonAction from './ButtonAction.vue'

export default {
	props: {
		title: String
	},
	data() {
		return {
			token: '',
			language: false,
			languages: [],
			lang: 'pl'
		}
	},
    provide() {
        const editLang = {}
        Object.defineProperty(editLang, 'lang', {
            enumerable: true,
            get: () => this.lang,
        })
        return { editLang }
    },
	mounted() {
        this.findFormElements(this.$children);
		this.token = document.querySelector('meta[name="csrf-token"]').content;
		this.languages = window.languages;
	},
	computed: {
		current_language() {
			if (this.languages) {
				const language = this.languages.find(e => e.code == this.lang);
				if (language === undefined) {
					return {flag: null, name: null};
				} else {
					return language;
				}
			}
			return {flag: null, name: null};
		}
	},
	methods: {
		setLanguage(code) {
			this.lang = code;
		},
		findFormElements(children) {
            children.forEach(el => {
                const translate = (el.$options !== undefined && el.$options.propsData !== undefined && el.$options.propsData.translate !== undefined) ? el.$options.propsData.translate : false;

                if (translate) {
					this.language = true;
				}
                this.findFormElements(el.$children);
            });
        },
	},
    components: {
        ButtonAction
    }
}
</script>
