<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

class Section extends Component
{
	public function render() {
		$this->set_class_name('section');
		$this->set_tag('section');

		return view('frontend::components.layout.section', $this->data());
	}
}
