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
		public $params = [];
		public $watch;

        public function __construct($id = null, $id_directory = null, $label = null, $items = [], $selected = [], $name = null, $url = null, $params = [], $watch = []) {
            $this->id = $id;
            $this->label = $label;
			$this->id = $id;
			if ($id_directory) {
            	$this->items = get_dictionary($id);
			}
			$this->name = $name;
            $this->selected = $selected;
			$this->url = $url;
			$this->params = json_encode($params);
			foreach($watch as $key => $value) {
				$this->watch .= '$watch(\''.$key.'\', value => '.$value.'); ';
			}
        }

		public function render() {
			return ;
		}
	}

?>
