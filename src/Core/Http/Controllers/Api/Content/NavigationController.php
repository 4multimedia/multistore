<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Api\Content;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Classes\Navigation;
	use Multimedia\Multistore\Core\Http\Controllers\Controller;
use Multimedia\Multistore\Core\Models\Navigation as ModelsNavigation;

    class NavigationController extends Controller
    {
		public $navigation;

		public function __construct() {
			$this->navigation = new Navigation();
		}

		public function index(ModelsNavigation $navigation) {
			$item = new Navigation($navigation->id_navigation);
			return $item->render();
		}

		public function store(Request $request) {
			$this->navigation->store($request);
		}

		public function position(Request $request) {
			$this->navigation->position($request->item["id"], $request->item["position"]);
		}

		public function move(Request $request) {
			$this->navigation->move($request->item["id"], $request->item["id_navigation_parent"], $request->item["position"]);
		}

        public function delete(Request $request) {
            $this->navigation->delete($request->id);
        }
    }
