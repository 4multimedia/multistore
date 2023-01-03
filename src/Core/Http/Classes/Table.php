<?php

	namespace Multimedia\Multistore\Core\Http\Classes;

	class Table {

		public $perPageOptions = [10, 20, 50, 100];
		public $items = [];

		public function __construct($params = []) {
			if (isset($params["perPageOptions"])) {
				$this->perPageOptions = $params["perPageOptions"];
			}

			if(isset($params["items"])) {
				$this->items = $params["items"];
			}
		}


	}

?>
