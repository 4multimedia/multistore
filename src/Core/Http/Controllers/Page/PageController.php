<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Page;

    use App\Http\Controllers\Controller;

    class PageController extends Controller
    {
        public function accessBlocked() {
			return view('backend::page.accessBlocked');
        }
    }
