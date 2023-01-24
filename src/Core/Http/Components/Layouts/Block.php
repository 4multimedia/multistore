<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Block extends Component
{
	public function render() {
		$this->set_tag('div');

		return view('frontend::components.layout.block', $this->data());
	}
}
