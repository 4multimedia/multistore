<?php

	namespace Multimedia\Multistore\Core\Http\Classes;

	class Table {

		public $perPageOptions = [10, 20, 50, 100];
		public $fields = [];
		public $items = [];

		public function __construct($params = []) {
			if (isset($params["perPageOptions"])) {
				$this->perPageOptions = $params["perPageOptions"];
			}

			if(isset($params["fields"])) {
				$this->fields = $params["fields"];
			}

			if (isset($params["query"])) {
				$this->items($params["query"]);
			}

			if (isset($params["items"])) {
				$this->items = $params["items"];
			}
		}

		public function items($items) {
			$this->items = [];
			foreach($items as $item) {
				$this->items[] = $item->getAttributes();
			}
		}

		public function render() {
			print_r($this->items);
			return view('backend::table.index');
		}
	}

?>
