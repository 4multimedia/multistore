<?php

	namespace Multimedia\Multistore\Classes;

	use Multimedia\Multistore\Core\Models\Layout as LayoutModel;

    class Layout {

		public $css = [];

		public $attributes = [
			'minheight',
			'width',
			'height',
			'background_type',
			'background_color',
			'constraints'
		];

		public function get_elements() {
			$items = [];
			$elements = LayoutModel::get();
			if ($elements) {
				foreach($elements as $element) {
					$items[] = $element->content;
				}
			}

			return $items;
		}

		public function extract_css($items) {
			foreach($items as $item) {
				if (isset($item["setting"])) {
					$this->create_class($item["uuid"], $item["setting"]);
				}

				if (isset($item["children"])) {
					$this->extract_css($item["children"]);
				}

				if (isset($item["content"])) {
					$this->extract_css($item["content"]);
				}
			}
			return $this;
		}

		public function constraints($settings) {

			$constraints = $settings["constraints"];

			$return = [];
			if (isset($constraints["padding.top"])) {
				$return[] = "\tpadding-top: ".$constraints["padding.top"]."px;";
			}
			if (isset($constraints["padding.bottom"])) {
				$return[] = "\tpadding-bottom: ".$constraints["padding.bottom"]."px;";
			}
			if (isset($constraints["padding.left"])) {
				$return[] = "\tpadding-left: ".$constraints["padding.left"]."px;";
			}
			if (isset($constraints["padding.right"])) {
				$return[] = "\tpadding-right: ".$constraints["padding.right"]."px;";
			}
			if (isset($constraints["margin.top"])) {
				$return[] = "\tmargin-top: ".$constraints["margin.top"]."px;";
			}
			if (isset($constraints["margin.bottom"])) {
				$return[] = "\tmargin-bottom: ".$constraints["margin.bottom"]."px;";
			}
			if (isset($constraints["margin.left"])) {
				$return[] = "\tmargin-left: ".$constraints["margin.left"]."px;";
			}
			if (isset($constraints["margin.right"])) {
				$return[] = "\tmargin-right: ".$constraints["margin.right"]."px;";
			}

			if (count($return) > 0) {
				return implode("\n", $return);
			}
		}

		public function background_type($settings) {

		}

		public function background_color($settings) {
			$background_color = $settings["background.color"];
			if ($background_color) {
				return "\tbackground-color: ".$background_color.";";
			}
		}

		public function create_class($uuid, $settings) {
			$inline = [];
			foreach($settings as $setting => $value) {
				$setting = strtr($setting, ['.' => '_']);
				if (in_array($setting, $this->attributes)) {
					if (method_exists($this, $setting)) {
						$inline[] = $this->$setting($settings);
					}
				}
			}

			if (count($inline) > 0) {
				$this->css[] = ".element_$uuid { ".implode("\n", $inline)." \n}";
			}
		}

		public function render() {
			print_r($this->css);
		}

		public function save() {
			$path = public_path('css');
			file_put_contents($path."/_elements.css", implode("\n", $this->css));
			$path = resource_path('css');
			file_put_contents($path."/_elements.css", implode("\n", $this->css));
		}
	}
