<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Media;

    use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;

    class MediaController extends Controller
    {
        public function index(Request $request) {
			set_title(__('backend::media.title'));
			add_action_header('Wgraj plik');
			add_action_header('Dodaj folder');
			return view('backend::media.index', ['hash' => $request->hash]);
        }
    }
