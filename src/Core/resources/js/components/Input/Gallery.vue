<template>
    <div>
		<div class="pt-4 border-2 border-dashed rounded-md dark:border-darkmode-400" v-if="selected.length > 0">
			<div class="flex flex-wrap px-4">
				<div v-for="item, index in selected" :key="index" class="relative w-24 h-24 mb-5 mr-5 cursor-pointer image-fit zoom-in">
					<img class="rounded-md" alt="Midone Tailwind HTML Admin Template" :src="item.thumb">
					<div class="cursor-pointer absolute top-0 right-0 flex items-center justify-center w-5 h-5 -mt-2 -mr-2 text-white rounded-full bg-danger">
						<X color="white" :size="16" />
					</div>
				</div>
			</div>
		</div>
        <button @click="onHandleOpenDialog" type="button">Wybierz zdjęcia</button>
        <dialog-media :append-to="self" :display.sync="dialog" :limit="limit" @onSelect="onSelect" :allow="['jpg', 'jpeg', 'svg', 'png', 'gif']"></dialog-media>
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
		}
    }
}
</script>
