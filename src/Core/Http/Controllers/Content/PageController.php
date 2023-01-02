<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Content;

    use App\Http\Controllers\Controller;

    class PageController extends Controller
    {
        public function index() {
			set_title(__('backend::page.title'));
			return view('backend::content.page.index');
		}
    }
