<?php

	namespace Multimedia\Multistore\Classes;

	use Multimedia\Multistore\Core\Models\Dictionary as ModelsDictionary;

    class Dictionary {
		public $items = [];

		public function register($label, $group, $priority, $options = []) {
			add_to_menu('dictionary', 'Słowniki', null, 94, ['icon' => 'book']);
			add_to_submenu('dictionary', $label, 'backend.dictionary', $priority, ['route' => ['group' => $group]]);
			$this->items[] = ['label' => $label, 'group' => $group, 'options' => $options];
		}

		public function get_name($group) {
			foreach($this->items as $item) {
				if ($item["group"] == $group) {
					return $item["label"];
				}
			}
		}

		public function get_options($group) {
			foreach($this->items as $item) {
				if ($item["group"] == $group) {
					return $item["options"];
				}
			}
		}

		public function get_id($group) {
			$name = $this->get_name($group);
			$item = ModelsDictionary::where('options->group', $group)->first();
			if (!$item) {
				$item = ModelsDictionary::create([
					'name' => ['pl' => $name],
					'options' => array_merge($this->get_options($group), ['group' => $group])
				]);
			}
			return $item->id_dictionary;
		}

		public function get($group) {
			return ModelsDictionary::where('options->group', $group)->first();
		}
	}
