<?php

	namespace Multimedia\Multistore\Core\Http\Components\Dictionary;

	use Illuminate\View\Component;

	class DictionaryCheckbox extends Component {

        public $label;
        public $id;
        public $items = [];
        public $selected = [];

        public function __construct($id, $label = null, $selected = []) {
            $this->id = $id;
            $this->label = $label;
            $this->items = get_dictionary($id);
            $this->selected = $selected;
        }

		public function render() {
			return view('backend::components.dictionary.checkbox');
		}
	}

?>
