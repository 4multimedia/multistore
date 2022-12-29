<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Api\Media;

    use App\Http\Controllers\Controller;

    class MediaController extends Controller
    {
        public function index() {
			set_title(__('backend::media.title'));
			add_action_header('Wgraj plik');
			add_action_header('Dodaj folder');
			return view('backend::media.index');
        }
    }
