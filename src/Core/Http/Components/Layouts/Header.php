<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Header extends Component
{
	public function render() {
		return view('backend::frontend.components.layout.header', $this->data());
	}
}
