<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Layout;

    use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;

    class SettingController extends Controller
    {
        public function index() {
			set_title(__('backend::layout.Layout'));
			$data = get_option('layout_setting', []);
			$colors = [];
			$colors["general"] = [];
			$colors["general"][] = ["name" => "Podstawowy", "color" => "#cccccc", "disabled" => true];
			$colors["general"][] = ["name" => "Podrzędny", "color" => "#cccccc", "disabled" => true];
			$colors["general"][] = ["name" => "Kolor tesktu", "color" => "#cccccc", "disabled" => true];
			$colors["general"][] = ["name" => "Akcent", "color" => "#cccccc", "disabled" => true];
			$colors["link"] = [];
			$colors["link"][] = ["name" => "Podstawowy", "color" => "#333333", "disabled" => true];
			$colors["link"][] = ["name" => "Po najechaniu", "color" => "#000000", "disabled" => true];
			$colors["additional"] = isset($data["color"]["additional"]) ? $data["color"]["additional"] : [];
			return view('backend::layout.setting.index', ['colors' => $colors]);
		}

        public function store(Request $request) {
			set_option('layout_setting', $request->except('_token'));
			return redirect()->route('backend.layout.setting.index')->with('success', 'Ustawienia zostały zapisane');
        }
    }
