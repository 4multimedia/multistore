<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Paragraph extends Component
{
	public function render() {
		$this->set_tag('p');

		return view('frontend::components.layout.paragraph', $this->data());
	}
}
