<?php

	namespace Multimedia\Multistore\Classes;

use Multimedia\Multistore\Core\Http\Classes\Table;

	class Tables {

		public $tables = [];

		public function create($id, $options) {
			$this->tables[$id] = new Table($id, $options);

			if (isset($options["headers"])) {
				foreach($options["headers"] as $header) {
					$name = $header["header"];
					unset($header["header"]);
					$this->tables[$id]->set_header($name, $header);
				}
			}

			if (isset($options["actions"])) {
				foreach($options["actions"] as $action) {
					$this->tables[$id]->set_action($action["id"], $action["name"], $action["route"], isset($action["options"]) ? $action["options"] : []);
				}
			}
		}

		public function render($id) {
			return $this->tables[$id]->render();
		}
	}
