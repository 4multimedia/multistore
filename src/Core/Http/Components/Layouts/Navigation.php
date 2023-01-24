<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Navigation extends Component
{
	public function render() {
		$this->set_class_name('navigation');

		return view('frontend::components.layout.navigation', $this->data());
	}
}
