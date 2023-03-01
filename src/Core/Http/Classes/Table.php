<?php

	namespace Multimedia\Multistore\Core\Http\Classes;

    use Str;

	class Table {

		public $perPageOptions = [10, 20, 50, 100];
		public $fields = [];
		public $items = [];
        public $actions = [];
        public $visible = [];
        public $pagination;

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
                $this->pagination = $params["query"]->links();
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
				'bodyClass' => isset($options["bodyClass"]) ? $options["bodyClass"] : null,
                'type' => isset($options["type"]) ? $options["type"] : 'string',
            ];
        }

        public function action_icon($id, $icon) {
            if ($id === 'edit') {
                return 'edit2';
            } else if ($id === 'delete') {
                return 'trash';
            } else if ($icon) {
                return $icon;
            } else {
                return null;
            }
        }

        public function action($id, $label, $route = null, $options = []) {
            return [
                'id' => Str::slug($id),
                'label' => $label,
                'route' => $route ? $route : 'javascript;;',
                'icon' => $this->action_icon($id, isset($options["icon"]) ? $options["icon"] : null),
                'method' => isset($options["method"]) ? $options["method"] : null,
                'class' => isset($options["class"]) ? $options["class"] : null,
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
            foreach($this->items as $index => $item) {
                $array[] = $this->item($item, $index);
            }
            return $array;
        }

        public function template($template, $item) {
            $template = strtr($template, ['%24' => '$']);
            preg_match_all('/(\$[a-z0-9_-]+)/', $template, $variables);
            $strtr = [];
            foreach($variables[0] as $variable) {
				$value = $item->{strtr($variable, ['$' => ''])};
				$value = is_array($value) ? $value["pl"] : $value;

                $strtr["{$variable}"] = $value;
            }
            return strtr($template, $strtr);
        }

        public function template_actions($item) {
            $array = [];
            $i = 0;
            foreach($this->actions as $key => $action) {

                if ($action["id"] === 'delete') {
                    $action["class"] = 'text-red-600';
                }

                if ($action["method"]) {
                    $key = time().rand(1000,9999);
                    $template = '<form class="hidden" method="POST" action="'.$action["route"].'" id="submit-route-'.$key.'">'.csrf_field().' '.method_field($action["method"]).'</form><a href="javascript:;" onclick="event.preventDefault(); document.getElementById(\'submit-route-'.$key.'\').submit();" class="dropdown-item '.$action["class"].'"><i data-lucide="'.$action["icon"].'" class="w-4 h-4 mr-2"></i> Usuń</a>';
                } else {
                    $template = '<a href="'.$action["route"].'" class="dropdown-item '.$action["class"].'"><i data-lucide="'.$action["icon"].'" class="w-4 h-4 mr-2"></i> '.$action["label"].' </a>';
                }

                if ($action["id"] === 'delete') {
                    $array[$i]["template"] = '<hr class="dropdown-divider" />';
                    $i++;
                }

                $array[$i] = $action;
                $array[$i]["template"] = $this->template($template, $item);

                $i++;
            }
            return $array;
        }

        public function item($item, $index) {
            $array = [];
            foreach($this->fields as $field) {
                $id = $field["id"];
                $array[$id]["value"] = $field["template"] === null ? $item->{$id} : $this->template($field["template"], $item);
				if (isset($field["type"]) && $field["type"] === 'boolean') {
					if ($array[$id]["value"] == 1 || $array[$id]["value"] == true) {
						$array[$id]["value"] = '<span class="text-green-600"><i data-lucide="check" class="w-4 h-4"></i></span>';
					} else if ($array[$id]["value"] == 0 || $array[$id]["value"] == false) {
						$array[$id]["value"] = '<span class="text-red-600"><i data-lucide="x" class="w-4 h-4"></i></span>';
					}
				}
				if ($id == 'no') {
					$array[$id]["value"] = $index+1;
				}
                $array[$id]["actions"] = $this->template_actions($item);
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
                'visible' => $this->visible,
                'pagination' => $this->pagination
            ];
			return view('backend::table.index', $data);
		}
	}

?>
