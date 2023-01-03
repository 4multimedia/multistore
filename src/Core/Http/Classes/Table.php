<?php

	namespace Multimedia\Multistore\Core\Http\Classes;

    use Str;

	class Table {

		public $perPageOptions = [10, 20, 50, 100];
		public $fields = [];
		public $items = [];
        public $actions = [];
        public $visible = [];

		public function __construct($id, $params = []) {
			if (isset($params["perPageOptions"])) {
				$this->perPageOptions = $params["perPageOptions"];
			}

			if(isset($params["fields"])) {
				$this->fields = $params["fields"];
                $this->fields();
			}

			if (isset($params["query"])) {
				$this->items($params["query"]);
			}

			if (isset($params["items"])) {
				$this->items = $params["items"];
			}
		}

        public function header($label, $options = []) {
            return [
                'id' => isset($options["id"]) ? $options["id"] : Str::slug($label),
                'label' => $label,
                'sortable' => isset($options["sortable"]) ? $options["sortable"] : false,
                'filter' => isset($options["filter"]) ? $options["filter"] : [],
                'template' => isset($options["template"]) ? $options["template"] : null,
                'headerClass' => isset($options["headerClass"]) ? $options["headerClass"] : null,
            ];
        }

        public function action($id, $label, $route = null, $options = []) {
            return [
                'id' => Str::slug($id),
                'label' => $label,
                'route' => $route ? $route : 'javascript;;',
                'icon' => 'edit'
            ];
        }

		public function items($items) {
			$this->items = [];
			foreach($items as $item) {
				$this->items[] = $item;
			}
            return $this;
		}

        public function values() {
            $array = [];
            foreach($this->items as $item) {
                $array[] = $this->item($item);
            }
            return $array;
        }

        public function template($template, $item) {
            $template = strtr($template, ['%24' => '$']);
            preg_match_all('/(\$[a-z0-9_-]+)/', $template, $variables);
            $strtr = [];
            foreach($variables[0] as $variable) {
                $strtr["{$variable}"] = $item->{strtr($variable, ['$' => ''])};
            }
            return strtr($template, $strtr);
        }

        public function item($item) {
            $array = [];
            foreach($this->fields as $field) {
                $array[$field["id"]] = $field["template"] === null ? $item->{$field["id"]} : $this->template($field["template"], $item);
            }
            return $array;
        }

        public function set_header($label, $options = []) {
            $this->fields[] = $this->header($label, $options);
            return $this;
        }

        public function set_action($id, $label, $route = null, $options = []) {
            $this->actions[] = $this->action($id, $label, $route, $options);
            return $this;
        }

		public function render() {
            $data = [
                'perPageOptions' => $this->perPageOptions,
                'fields' => $this->fields,
                'values' => $this->values(),
                'actions' => $this->actions,
                'visible' => $this->visible
            ];
			return view('backend::table.index', $data);
		}
	}

?>
