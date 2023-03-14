<template>
	<div class="form-inline items-start first:mt-0 first:pt-0 mt-3 flex-col" :class="{'xl:flex-row' : !column}">
		<div class="w-full xl:w-64 xl:!mr-10" :class="{'mb-2' : column}">
			<div class="font-medium">{{ label }}</div>
			<div v-if="help" class="leading-relaxed text-slate-500 text-xs mt-3">{{ help }}</div>
		</div>
		<div class="w-full mt-3 xl:mt-0 flex-1 border border-dashed dark:border-darkmode-400 rounded-md p-4">
			<div v-if="selected.length > 0">
				<draggable v-model="selected" class="flex flex-wrap">
					<div v-for="item, index in selected" :key="index" class="relative w-32 h-32 mb-5 mr-5 cursor-pointer image-fit zoom-in">
						<input type="hidden" :name="`_image[${name}][${index}][id]`" :value="item.id" />
						<input type="hidden" :name="`_image[${name}][${index}][name][pl]`" :value="item.alt.pl" />
						<img class="rounded-md" alt="" :src="item.paths.thumb">
						<div class="absolute top-0 right-0 dropdown ml-auto">
							<a href="avascript:;" class="dropdown-toggle flex items-center justify-center w-5 h-5 -mt-2 -mr-2 text-white rounded-full bg-green-500" aria-expanded="false" data-tw-toggle="dropdown">
								<Settings color="white" :size="16" />
							</a>
							<div class="dropdown-menu w-48">
                                <ul class="dropdown-content">
                                    <li><a href="javascript:;" @click="editImage(item)" class="dropdown-item"><Pencil class="w-4 h-4 mr-2" /> Edytuj </a></li>
									<li><a href="javascript:;" class="dropdown-item"><RefreshCw class="w-4 h-4 mr-2" /> Regeneruj rozmiary </a></li>
                                    <li><a href="javascript:;" @click="removeImage(index)" class="dropdown-item"><Trash2 class="w-4 h-4 mr-2" /> Usuń zdjęcie </a></li>
                                </ul>
                            </div>
						</div>
					</div>
				</draggable>
			</div>
			<button @click="onHandleOpenDialog" class="btn bg-white w-32 ml-auto" type="button">Wybierz zdjęcia</button>
			<dialog-media :append-to="self" :display.sync="dialog" :selected="selected" :limit="limit" @onSelect="onSelect" :allow="['jpg', 'jpeg', 'svg', 'png', 'gif']"></dialog-media>
			<Dialog :visible.sync="dialogEdit" header="Edytuj" appendTo="body" :modal="true" :closable="false" :closeOnEscape="false">
				<input-text label="Tekst alternatywny [alt]" />
				<template #footer>
					<Button label="Anuluj" icon="pi pi-times" class="p-button-text"/>
					<Button label="Zapisz" icon="pi pi-check" autofocus />
				</template>
			</Dialog>
		</div>
	</div>
</template>

<script>
import { Settings, Trash2, Pencil, RefreshCw } from 'lucide-vue';
import FileUpload from 'primevue/fileupload';
export default {
	components: {
		Settings,
		Trash2,
		Pencil,
		RefreshCw,
		FileUpload
	},
	props: {
		column: {
            type: Boolean,
            default: false
        },
		limit: {
			type: Number,
			default: -1
		},
		error: [String, Array, Object],
		value: [String, Array, Object],
		name: String,
		label: String,
		help: String
	},
    data() {
        return {
			selected: [],
            dialog: false,
			dialogEdit: false
        }
    },
	mounted() {
		if (this.value) {
			this.selected = JSON.parse(this.value);
		}
	},
    methods: {
        onHandleOpenDialog() {
            this.dialog = true;
        },
		onSelect(selected) {
			this.selected = selected;
		},
		removeImage(index) {
			this.selected.splice(index, 1);
		},
		editImage(item) {
			this.dialogEdit = true;
		}
    }
}
</script>
