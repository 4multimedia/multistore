<template>
	<div>
        <div class="intro-y flex items-center mt-8  justify-between">
			<h2 class="text-lg font-medium mr-auto">Media</h2>
            <button @click="onHandleOpenDialog('file')" class="btn btn-primary shadow-md w-32 ml-2">Wgraj plik</button>
            <button @click="onHandleOpenDialog('directory')" class="btn btn-primary shadow-md w-32 ml-2">Dodaj folder</button>
		</div>
        <div class="grid grid-cols-12 gap-6 mt-8">
            <div class="col-span-12 lg:col-span-3 2xl:col-span-2">
                <media-search class="intro-y"></media-search>
                <div class="intro-y box p-5 mt-5">
                    <div class="mt-1">
                        <span @click="onHandleGetType('all')" class="cursor-pointer flex items-center px-3 py-2 rounded-md" :class="{'bg-primary text-white font-medium' : type == 'all'}"><Files class="w-4 h-4 mr-2" /> Wszystkie pliki </span>
                        <span @click="onHandleGetType('images')" class="cursor-pointer flex items-center px-3 py-2 mt-2 rounded-md" :class="{'bg-primary text-white font-medium' : type == 'images'}"><FileImage class="w-4 h-4 mr-2" /> Pliki graficzne </span>
                        <span @click="onHandleGetType('docs')" class="cursor-pointer flex items-center px-3 py-2 mt-2 rounded-md" :class="{'bg-primary text-white font-medium' : type == 'docs'}"><FileText class="w-4 h-4 mr-2" /> Dokumenty </span>
                        <span @click="onHandleGetType('archive')" class="cursor-pointer flex items-center px-3 py-2 mt-2 rounded-md" :class="{'bg-primary text-white font-medium' : type == 'archive'}"><FileArchive class="w-4 h-4 mr-2" /> Spakowane pliki </span>
                        <span @click="onHandleGetType('trash')" class="cursor-pointer flex items-center px-3 py-2 mt-2 rounded-md" :class="{'bg-primary text-white font-medium' : type == 'trash'}"><Trash2 class="w-4 h-4 mr-2" /> Usunięte </span>
                    </div>
                    <div class="border-t border-slate-200 dark:border-darkmode-400 mt-4 pt-4">
                        <span class="cursor-pointer flex items-center px-3 py-2 mt-2 rounded-md"><Plus class="w-4 h-4 mr-2" /> Dodaj tag </span>
                    </div>
                </div>

                <ui-tip class="mt-5 intro-y"></ui-tip>
            </div>
            <div class="col-span-12 lg:col-span-9 2xl:col-span-10">
                <div class="mb-5 flex">
                    <ChevronLeft v-if="item && item.path && item.path.length > 0" class="w-4 h-4 cursor-pointer text-slate-500 mr-2 mt-1" @click="onHandleGetItems(back)" />
                    <div>
                        <div class="text-base font-medium flex items-center">
                            <span v-if="item.name">{{ item.name }}</span>
                            <span v-else>Media</span>
                        </div>
                        <div class="text-xs text-slate-600 flex items-center">
                            <span class="cursor-pointer" @click="onHandleGetItems('')">Media</span>
                            <div class="flex items-center" v-for="path, index in item.path" :key="index">
                                <ChevronRight class="mx-1 text-slate-500 w-3 h-3" />
                                <span  @click="onHandleGetItems(path.hash)" class="cursor-pointer">{{ path.name }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6" v-if="items.length > 0">
                    <div v-for="item, index in items" :key="index" class="intro-y col-span-6 sm:col-span-4 md:col-span-3 2xl:col-span-2">
                        <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in" @click="onHandleGetItems(item.hash)">
                            <div class="absolute left-0 top-0 mt-3 ml-3">
                                <input class="form-check-input border border-slate-500" type="checkbox">
                            </div>
                            <span class="w-3/5 file__icon file__icon--empty-directory mx-auto"></span>
                            <span class="block font-medium mt-4 text-center truncate">{{ item.name }}</span>
                            <div class="text-slate-500 text-xs text-center mt-0.5"><span>5 folderów</span> | <span>25 plików</span></div>
                            <div class="absolute top-0 right-0 mr-2 mt-3 dropdown ml-auto">
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else class="intro-y flex items-center justify-center flex-col h-full">
                    <div class="text-lg font-medium">Nie masz jeszcze żadnych folderów ani plików</div>
                    <p class="text-md mt-5 w-96 text-center">Dodawaj i zarządzaj plikami, twórz foldery aby zorgainizować i uprządkować pliki.</p>
                    <button @click="onHandleOpenDialog('directory')" class="btn bg-white shadow-md w-32 my-5">Dodaj folder</button>
                    <p class="text-xs text-slate-500 font-medium">Potrzebujesz wsparcia? Zajrzyj do <a href="" class="text-blue-500 underline">Centrum Pomocy</a></p>
                </div>
            </div>
        </div>

        <Dialog header="Dodaj folder" :visible.sync="dialog.directory" :modal="true">
            <div style="width:600px; max-width: 100%;" class="intro-y box p-5">
                <input-text column label="Nazwa folderu" :error="error.directory['name']" :value.sync="form.directory.name" />
            </div>

            <template #footer>
                <div class="col-span-12 flex items-center">
                    <button class="btn bg-white w-32 ml-auto" @click="onHandleHideDialog('directory')">Anuluj</button>
                    <button class="btn btn-primary w-32 ml-2" @click="onHandleSaveDirectory">Dodaj folder</button>
                </div>
            </template>
        </Dialog>
	</div>
</template>

<script>
import axios from 'axios';
import MediaSearch from './Search.vue';
import { Files, FileImage, FileText, FileArchive, Trash2, Plus, ChevronLeft, ChevronRight } from 'lucide-vue';

export default {
	props: {
		root: String
	},
    components: {
        Files,
        FileImage,
        FileText,
        FileArchive,
        Trash2,
        Plus,
        ChevronLeft,
        ChevronRight,
        MediaSearch
    },
	data() {
		return {
            type: 'all',
			id_parent: '',
			items: [],
            item: {
                path: []
            },
            dialog: {
                directory: false,
                file: false
            },
            error: {
                directory: {},
                file: {}
            },
            form: {
                directory: {
                    name: ''
                }
            }
		}
	},
	methods: {
		async onHandleGetItems(hash) {
			this.id_parent = hash;
			await this.getItems();
			window.history.pushState({}, null, `/admin/media/${this.id_parent}`);
		},
		async getItems() {
			let url = `/admin/api/media/directory/${this.id_parent}`;
			const request = await axios.get(url);
			const { data } = request;
			this.items = data;

            if (this.id_parent) {
                url = `/admin/api/media/directory/view/${this.id_parent}`;
                const request = await axios.get(url);
                this.item = request.data;
            } else {
                this.item = {};
            }
		},
        async onHandleSaveDirectory() {
            try {
                let url = `/admin/api/media/directory/${this.id_parent}`;
                const request = await axios.post(url, this.form.directory);
                this.form.directory.name = '';
                this.dialog.directory = false;
                await this.getItems();
            } catch(e) {
                this.error.directory = e.response.data.errors;
            }
        },
        onHandleGetType(type) {
            this.type = type;
        },
        onHandleOpenDialog(type) {
            this.form.directory.name = '';
            this.dialog[type] = true;
        },
        onHandleHideDialog(type) {
            this.dialog[type] = false;
        }
	},
    computed: {
        back() {
            if (this.item && this.item.path && this.item.path.length > 1) {
                return this.item.path[this.item.path.length-2].hash;
            }
            return '';
        }
    },
	mounted() {
		this.id_parent = this.root;
		this.getItems();

		var self = this;
		window.addEventListener('popstate', function() {
			let path = window.location.pathname.split("/");
			path = path[3] === undefined ? '' : path[3];
			self.id_parent = path;
			self.getItems();
		}, false);
	},
}
</script>
