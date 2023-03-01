<?php

	namespace Multimedia\Multistore\Core\Http\Components;

	use Illuminate\View\Component;

	class Editor extends Component {
        public $label = '';

        public function __construct($label = null)
        {
            $this->label = $label;
        }

		public function render() {
			return view('backend::components.editor');
		}
	}

?>
