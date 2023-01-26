<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Navigation extends Component
{
	public function render() {
		$this->set_class_name('navigation');
		print_r($this->data());
		return view('frontend::components.layout.navigation', $this->data());
	}
}
