<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Column extends Component
{
	public function render() {
		$this->set_class_name('col');

		return view('frontend::components.layout.column', $this->data());
	}
}
