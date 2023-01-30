<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

use Multimedia\Multistore\Core\Models\Navigation as ModelsNavigation;

class Navigation extends Component
{
	public function set_setting() {
		$data["items"] = [];
		if (isset($this->setting["id_menu"])) {
			$navigation = ModelsNavigation::find($this->setting["id_menu"]);
			$data["items"] = $navigation->items;
		}

		return $data;
	}

	public function render() {
		$this->set_class_name('navigation');
		return view('frontend::components.layout.navigation', $this->data());
	}
}
