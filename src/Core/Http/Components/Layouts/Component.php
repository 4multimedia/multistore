<?php

namespace Multimedia\Multistore\Core\Http\Components\Layouts;

use Illuminate\View\Component as BaseComponent;

class Component extends BaseComponent
{
	public $elements = [];
	public $className = [];
	public $options = [];
	public $setting = [];
	public $tag = 'div';
	public $uuid = '';

	public function __construct($elements, $uuid = '', $setting = [])
	{
		$this->elements = $elements;
		$this->uuid = $uuid;
		$this->setting = $setting;
	}

	public function set_options() {
		$this->set_class_name('element_'.$this->uuid);

		$this->options = [];
		$this->options["class"] = $this->className;
	}

	public function set_class_name($className) {
		if (!in_array($className, $this->className)) {
			$this->className[] = $className;
		}
	}

	public function set_tag($tag) {
		$this->tag = $tag;
	}

	public function set_setting() {
		return [];
	}

	public function data() {
		$this->set_options();

		return array_merge([
			'elements' => $this->elements,
			'options' => $this->options,
			'tag' => $this->tag,
			'className' => implode(" ", $this->className)
		], $this->set_setting());
	}

	public function render() {

	}
}
