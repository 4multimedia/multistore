<template>
	<Editor component='div' :resolverMap="resolverMap">
		<div class="container-fluis">
			<div class="d-flex">
				<div class="col">
					<PanelElements />
					<PanelSettings />
					<PanelBreakpoints :breakpoint.sync="breakpoint" :breakpoints="breakpoints" @onSelectBreakpoint="onSelectBreakpoint" />
				</div>
				<div class="col-10">
					<PanelRules :breakpoint="breakpoint">
						<Frame component="div" class="visualbuilder-preview">
							<Canvas component="Container"></Canvas>
						</Frame>
					</PanelRules>
				</div>
			</div>
		</div>
	</Editor>
</template>

<script>
import Canvas from './Core/Canvas.vue';
import Frame from './Core/Frame.vue';
import Editor from './Core/Editor.vue';
import PanelSettings from './Panels/Settings.vue';
import PanelElements from './Panels/Elements.vue';
import PanelRules from './Panels/Rules.vue';
import PanelBreakpoints from './Panels/Breakpoints.vue';

import Container from './Elements/Container.vue';
import Column from './Elements/Column/Index.vue';
import Headline from './Elements/Headline/Index.vue';
import Paragraph from './Elements/Paragraph.vue';
import Row from './Elements/Row/Index.vue';

export default {
	components: {
		Canvas,
		Editor,
		Frame,
		Headline,
		PanelElements,
		PanelRules,
		PanelSettings,
		PanelBreakpoints
	},
	mounted() {
		this.onSelectBreakpoint('xxl');
	},
	methods: {
		onSelectBreakpoint(id) {
			const item = this.breakpoints.find(e => e.id === id);
			if(item) {
				this.breakpoint = item;
			}
		}
	},
	data() {
		  return {
			breakpoint: {

			},
			breakpoints: [
				{id: 'xxl', name: 'XXL', size: '1400', full: true},
				{id: 'xl', name: 'XL', size: '1200', full: true},
				{id: 'lg', name: 'LG', size: '992', full: true},
				{id: 'md', name: 'MD', size: '768', full: false},
				{id: 'sm', name: 'SM', size: '576', full: false},
				{id: 'xs', name: 'XS', size: '576', full: false},
			],
			resolverMap: {
				Canvas,
				Column,
				Row,
				Paragraph,
				Headline,
				Container
			}
		}
	}
}
</script>
