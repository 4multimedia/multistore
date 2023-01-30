<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Frontend\Content;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Controllers\Controller;
	use Multimedia\Multistore\Core\Models\Page;

    class PageController extends Controller
    {
		public function view(Request $request) {
			$slug = $request->page;
			$page = Page::where('slug->'.$this->lang, $slug)->first();
			if ($page) {
				return view('frontend::content.page');
			} else {
				abort(404);
			}
		}
    }
