<template>
	<div>
		<div class="intro-y grid grid-cols-12 gap-3 sm:gap-6">
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
	</div>
</template>

<script>
import axios from 'axios';

export default {
	props: {
		root: String
	},
	data() {
		return {
			id_parent: '',
			items: []
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
