<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Frontend\Content;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Controllers\Controller;
	use Multimedia\Multistore\Core\Models\Page;

    class PageController extends Controller
    {
        public function index() {
            return render_view('frontend::content.index');
        }

		public function view(Request $request) {
			$slug = $request->page;
			$page = Page::where('slug->'.$this->lang, $slug)->first();
			if ($page) {
				set_title($page->name);
				add_action('set_breadcrumbs', ['label' => $page->name]);
				$data["page"] = $page;
				return view('frontend::content.page', $data);
			} else {
				abort(404);
			}
		}
    }
