<?php

	namespace Multimedia\Multistore\Core\Http\Classes;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Models\Navigation as NavigationModel;

	class Navigation {

		public $id_navigation = null;

		public function __construct($id_navigation = null) {
			$this->id_navigation = $id_navigation;
		}

		public function storeNode($id_navigation_parent, $nodes) {
			foreach($nodes as $node) {
				$navigation = NavigationModel::create([
					'id_navigation_parent' => $id_navigation_parent,
					'route' => $node["name"]
				]);
				$this->storeNode($navigation->id_navigation, $node["items"]);
			}
		}

		public function store(Request $request) {
			$this->storeNode(1, $request->items);
			return $request->items;
		}

		public function render() {

		}
	}
