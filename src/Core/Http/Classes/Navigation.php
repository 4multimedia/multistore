<?php

	namespace Multimedia\Multistore\Core\Http\Classes;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Models\Navigation as NavigationModel;

	class Navigation {

		public $id_navigation = null;

		public function __construct($id_navigation = null) {
			$this->id_navigation = $id_navigation;
		}

		public function storeNode($node) {
            $position = $node["position"];
			$navigation = NavigationModel::create([
				'id_navigation_parent' => $node["id_navigation_parent"],
				'label' => $node["label"],
                'module' => $node["module"],
                'route' => $node["route"],
                'id_record' => $node["id_record"],
				'position' => $position
			]);

            $this->position($navigation->id_navigation, $position);
		}

		public function store(Request $request) {
			$this->storeNode($request->item);
		}

		public function render() {
			return NavigationModel::find($this->id_navigation)->items;
		}

		public function position($id_navigation, $position) {
			$primary = NavigationModel::find($id_navigation);

			$prevs = NavigationModel::where('id_navigation_parent', $primary->id_navigation_parent)->where('position', '<=', $position)->where('id_navigation', '!=', $id_navigation)->orderBy('position', 'ASC')->get();
			foreach($prevs as $index => $item) {
				$item->update(['position' => $index]);
			}

			$nexts = NavigationModel::where('id_navigation_parent', $primary->id_navigation_parent)->where('position', '>=', $position)->where('id_navigation', '!=', $id_navigation)->orderBy('position', 'ASC')->get();
			foreach($nexts as $index => $item) {
				$item->update(['position' => $index + ($position + 1)]);
			}

			$primary->update(['position' => $position]);
		}

		public function move($id_navigation, $new_node, $position) {
			$primary = NavigationModel::find($id_navigation);

			$items = NavigationModel::where('id_navigation_parent', $primary->id_navigation_parent)->where('id_navigation', '!=', $id_navigation)->orderBy('position', 'ASC')->get();
			foreach($items as $index => $item) {
				$item->update(['position' => $index]);
			}

			$primary->update(['id_navigation_parent' => $new_node]);
			$this->position($id_navigation, $position);
		}

        public function delete($id_navigation) {
            $navigation = NavigationModel::find($id_navigation);
            if ($navigation) {
                $navigation->delete();
            }
        }
	}
