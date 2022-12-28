<?php

	namespace Multimedia\Multistore\Classes;

	use Illuminate\Support\Facades\File;

	class Menu {

		public $items = [];
        public $subitems = [];

		public function add_to_menu($id, $label, $route, $priority, $params) {
			$this->items[$priority][] = [
                "id" => $id,
				"label" => $label,
				"route" => $route,
				"icon" => isset($params["icon"]) ? $params["icon"] : null,
				"items" => []
			];
		}

        public function sort() {
            ksort($this->items);

            $array = [];
            foreach($this->items as $items) {
                foreach ($items as $item) {
                    $subarray = [];
                    if (isset($item["id"]) && isset($this->subitems[$item["id"]])) {
                        ksort($this->subitems[$item["id"]]);
                        foreach($this->subitems[$item["id"]] as $subitems) {
                            foreach($subitems as $subitem) {
                                $subarray[] = $subitem;
                            }
                        }
                    }

                    if (!isset($item["id"])) {
                        $item["id"] = "d_".rand(0,1000);
                    }
                    $array[$item["id"]] = $item;
                    $array[$item["id"]]["items"] = $subarray;
                }
            }

            $this->items = $array;
        }

		public function do_menu() {
            $this->sort();

			$html = '<nav class="side-nav">';
			$html .= $this->items($this->items);
			$html .= '</nav>';

			return $html;
		}

		public function get_json_menu() {
			$array = [];
			foreach($this->items as $key => $item) {
				$array[$key] = $item;
				$array[$key]["label"] = __($array[$key]["label"]);
				$array[$key]["path"] = $item["route"] ? route($item["route"]) : '';

				foreach($item["items"] as $subkey => $subitem) {
					$array[$key]["items"][$subkey] = $subitem;
					$array[$key]["items"][$subkey]["label"] = __($array[$key]["items"][$subkey]["label"]);
					$array[$key]["items"][$subkey]["path"] = $array[$key]["items"][$subkey]["route"] ? route($array[$key]["items"][$subkey]["route"]) : '';
				}
			}
			return json_encode($array);
		}

		public function current_route() {
			return \Request::route()->getName();
		}

		public function items($items) {
			$html = '<ul class="">';
			foreach($items as $item) {
                if (isset($item["type"]) && $item["type"] === 'devider') {
                    $html .= '<li class="side-nav__devider my-6"></li>';
                } else {
				$html .= '
                    <li>
                        <a href="'.($item["route"] ? route($item["route"]) : 'javascript:;').'" class="side-menu '.($this->current_route() === $item["route"] ? 'side-menu--active' : '').'">
                            '.($item["icon"] ? '<div class="side-menu__icon"> <i data-lucide="'.$item["icon"].'"></i> </div>' : '').'
                            <div class="side-menu__title">
                                '.__($item["label"]).'
                                '.(count($item["items"]) > 0 ? '<div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i></div>' : '').'
                            </div>
                        </a>
                        '.(count($item["items"]) > 0 ? $this->items($item["items"]) : '').'
                    </li>';
                }
			}
			$html .= '</ul>';
			return $html;
		}

		public function add_to_submenu($id, $label, $route, $priority, $params) {
			$this->subitems[$id][$priority][] = [
				"label" => $label,
				"route" => $route,
				"icon" => isset($params["icon"]) ? $params["icon"] : null,
				"items" => []
			];
		}

        public function add_devider_menu($priority) {
            $this->items[$priority][] = ["type" => "devider"];
        }
	}
