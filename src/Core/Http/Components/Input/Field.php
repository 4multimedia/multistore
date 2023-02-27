<?php

	namespace Multimedia\Multistore\Core\Http\Components\Input;

	use Illuminate\View\Component;

	class Field extends Component {

        public $label;
        public $id;
		public $name;
		public $url;
        public $items = [];
        public $selected = [];

        public function __construct($id = null, $label = null, $items = [], $selected = [], $name = null, $url = null) {
            $this->id = $id;
            $this->label = $label;
			$this->items = $items;
			if ($id) {
            	$this->items = get_dictionary($id);
			}
			$this->name = $name;
            $this->selected = $selected;
			$this->url = $url;
        }

		public function render() {
			return ;
		}
	}

?>
