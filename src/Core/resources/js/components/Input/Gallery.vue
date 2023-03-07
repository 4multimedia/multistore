<template>
	<div class="form-inline items-start first:mt-0 first:pt-0 mt-3 flex-col xl:flex-row">
		<div class="w-full xl:w-64 xl:!mr-10">
			<div class="font-medium">Zdjęcia</div>
			<div class="leading-relaxed text-slate-500 text-xs mt-3">aaaaaa</div>
		</div>
		<div class="w-full mt-3 xl:mt-0 flex-1 border border-dashed dark:border-darkmode-400 rounded-md p-4">
			<div class="flex flex-wrap" v-if="selected.length > 0">
				<draggable v-model="selected">
					<div v-for="item, index in selected" :key="index" class="relative w-32 h-32 mb-5 mr-5 cursor-pointer image-fit zoom-in">
						<img class="rounded-md" alt="" :src="item.src">
						<div class="cursor-pointer absolute top-0 right-0 flex items-center justify-center w-5 h-5 -mt-2 -mr-2 text-white rounded-full bg-danger">
							<X color="white" @click="removeImage(index)" :size="16" />
						</div>
					</div>
				</draggable>
			</div>
			<button @click="onHandleOpenDialog" class="btn bg-white w-32 ml-auto" type="button">Wybierz zdjęcia</button>
			<dialog-media :append-to="self" :display.sync="dialog" :limit="limit" @onSelect="onSelect" :allow="['jpg', 'jpeg', 'svg', 'png', 'gif']"></dialog-media>
		</div>
	</div>
</template>

<script>
import { X } from 'lucide-vue'
export default {
	components: {
		X
	},
	props: {
		limit: {
			type: Number,
			default: 1
		}
	},
    data() {
        return {
			selected: [],
            dialog: false
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
		}
    }
}
</script>
