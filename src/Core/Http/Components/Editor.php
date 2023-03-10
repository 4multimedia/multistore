<?php

	namespace Multimedia\Multistore\Core\Http\Components;

	use Illuminate\View\Component;

	class Editor extends Component {
        public $label = '';
		public $translate = false;
		public $languages = [];

        public function __construct($label = null, $translate = false)
        {
            $this->label = $label;
			$this->translate = $translate;
			$this->languages = get_active_languages();
        }

		public function render() {
			return view('backend::components.editor');
		}
	}

?>
