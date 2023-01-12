<?php

	namespace Multimedia\Multistore\Core\Http\Components;

	use Illuminate\View\Component;

	class Layout extends Component {

		public $elements = [];

		public function render() {
			$this->elements = layout()->get_elements();

			return view('frontend::components.layout.index', ['elements' => $this->elements]);
		}
	}

?>
