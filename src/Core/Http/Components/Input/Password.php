<?php

	namespace Multimedia\Multistore\Core\Http\Components\Input;

	class Password extends Field {

		public function render() {
			return view('backend::components.input.password');
		}
	}

?>
