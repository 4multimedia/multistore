<?php

	namespace Multimedia\Multistore\Core\Http\Components\Input;

	class Text extends Field {

		public function render() {
			return view('backend::components.input.text');
		}
	}

?>
