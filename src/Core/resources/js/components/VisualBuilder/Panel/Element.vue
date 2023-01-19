<template>
	<div class="relative w-10 h-10 visual-elements-item">
		<button class="h-10 w-10 flex justify-center items-center rounded-full hover:bg-blue-500 hover:text-white text-slate-500 transition-all" v-tooltip="'Układy, bloki'">
			<component :is="icon(iconName)" :size="24" />
		</button>
		<div class="visual-elements-menu absolute top-0 left-10 -mt-2 hidden pl-2">
			<div class="ml-2 bg-white rounded-xl shadow-md w-96 overflow-hidden border border-slate-200">
				<draggable
					tag="section"
					:list="components[type].elements"
					:clone="onCloneItem"
					class="flex flex-wrap"
					style="margin-top:-1px;"
					:options="{ group:{ name:'visualComponents', pull:'clone', put: false }, sort:false, ghostClass: 'ghost' }"
				>
					<div
						v-for="element, element_index in components[type].elements"
						:key="element_index"
						:id="`${type}.${element.component}`"
						class="h-24 border-r border-slate-200 border-b flex items-center flex-col justify-center px-3 bg-white text-slate-700 hover:text-blue-400 cursor-move hover:bg-slate-50 transition-all"
						style="width:calc(12rem - 1px)"
					>
						<component :is="icon(element.icon)" :size="28" class="mb-4 text-slate-400" />
						<p class="text-sm text-center font-medium">{{ element.name }}</p>
					</div>
				</draggable>
			</div>
		</div>
	</div>
</template>

<script>
import Draggable from "vuedraggable";
import * as icons from 'lucide-vue';

export default {
	inject: ['components'],
	components: {
		Draggable
	},
	props: {
		iconName: String,
		type: String
	},
	methods: {
		icon(icon) {
			return icons[icon];
		},
	}
}
</script>
