<?php

	namespace Multimedia\Multistore\Classes;

	use Multimedia\Multistore\Core\Models\Layout as LayoutModel;

    class Layout {

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
	}
