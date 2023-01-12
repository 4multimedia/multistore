<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Row extends Component
{
	public function render() {
		$this->set_class_name('row');

		return view('frontend::components.layout.row', $this->data());
	}
}
