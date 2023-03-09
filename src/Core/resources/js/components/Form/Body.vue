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
            <div class="dropdown" style="position: relative;">
                <button class="dropdown-toggle btn btn-primary shadow-md flex items-center" type="button" aria-expanded="false" data-tw-toggle="dropdown">
                    Zapisz i wróć do listy <ChevronDown class="w-4 h-4 ml-2" />
                </button>
                <div class="dropdown-menu w-40" id="_o877v7wuw">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg> As New Post
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg> As Draft
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg> Export to PDF
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg> Export to Word
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

		<slot />
		<slot name="buttons">
			<button type="submit">ZAPISZ</button>
		</slot>
	</form>
</template>

<script>
import { ChevronDown } from 'lucide-vue';

export default {
	props: {
		language: {
			type: Boolean,
			default: false
		},
		title: String
	},
	data() {
		return {
			token: '',
			languages: [],
			lang: 'pl'
		}
	},
	mounted() {
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
		}
	},
	components: {
		ChevronDown
	}
}
</script>
