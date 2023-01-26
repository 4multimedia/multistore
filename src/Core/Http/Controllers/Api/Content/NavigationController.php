<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Api\Content;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Classes\Navigation;
	use Multimedia\Multistore\Core\Http\Controllers\Controller;

    class NavigationController extends Controller
    {
		public $navigation;

		public function __construct() {
			$this->navigation = new Navigation();
		}

		public function store(Request $request) {
			return $this->navigation->store($request);
		}
    }
