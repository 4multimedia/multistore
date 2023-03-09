<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Setting;

    use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;

    class LanguageController extends Controller {
		public function index() {
			set_meta_title('Wersje językowe');
			$data = [];

			$data["languages"] = get_languages();
			$data["options"] = get_option('setting.language', ['languages' => [], 'default' => null], true);

			return view('backend::setting.language.index', $data);
		}

		public function store(Request $request) {
			$default = $request->default;
			$languages = $request->status;
			if (!$languages) {
				$languages[$default] = 1;
			}

			$languages = array_merge($languages, [$default => 1]);
			$array = ['languages' => $languages, 'default' => $default];
			save_option('setting.language', $array, true, true);

			return redirect()->route('backend.setting.language');
		}
	}
