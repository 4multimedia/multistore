<?php

	namespace Multimedia\Multistore\Core\Http\Components;

	use Illuminate\View\Component;

	class Editor extends Component {
		public function render() {
			return view('backend::components.editor');
		}
	}

?>