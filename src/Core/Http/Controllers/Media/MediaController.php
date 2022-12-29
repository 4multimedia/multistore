<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Media;

    use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;

    class MediaController extends Controller
    {
        public function index(Request $request) {
			set_meta_title(__('backend::media.title'));
			return view('backend::media.index', ['hash' => $request->hash]);
        }
    }
