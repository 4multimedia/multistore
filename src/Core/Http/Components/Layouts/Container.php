<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Container extends Component
{
	public function render() {
		$this->set_class_name('container');

		return view('frontend::components.layout.container', $this->data());
	}
}
