<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Grid extends Component
{
	public function render() {
		$this->set_class_name('grid');

		return view('frontend::components.layout.grid', $this->data());
	}
}
