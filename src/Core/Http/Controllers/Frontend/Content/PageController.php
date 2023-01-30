<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Frontend\Content;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Controllers\Controller;

    class PageController extends Controller
    {
		public function view(Request $request) {
			$slug = $request->page;

			return view('frontend::content.page');
		}
    }
