<?php

	namespace Multimedia\Multistore\Classes;

	use Illuminate\Support\Facades\File;

	class Menu {

		public $items;

		public function add_to_menu($id, $label, $url, $params) {
			$this->items[$id] = [
				"label" => $label,
				"url" => $url
			];
		}

		public function do_menu() {
			$html = '<nav><ul>';
			foreach($this->items as $item) {
				$html .= '<li><a href="'.route('backend.auth.logout').'">'.$item["label"].'</li>';
			}
			$html .= '</ul></nav>';

			return $html;
		}
	}
