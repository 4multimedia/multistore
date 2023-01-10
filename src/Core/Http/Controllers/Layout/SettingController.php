<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Layout;

    use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;

    class SettingController extends Controller
    {
        public function index() {
			set_title(__('backend::layout.title'));
			return view('backend::layout.setting.index');
		}

        public function store(Request $request) {
			set_option('layout_setting', $request->except('_token'));
            set_title(__('backend::layout.create'));

			return redirect()->route('backend.layout.setting.index')->with('success', 'Ustawienia zostały zapisane');
        }
    }
