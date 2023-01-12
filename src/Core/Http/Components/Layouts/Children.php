<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Children extends Component
{
	public function render() {
		return view('frontend::components.layout.children', ['elements' => $this->elements]);
	}
}
