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
			$colors["general"][0] = ["name" => "Podstawowy", "color" => isset($data["color"]["general"][0]["color"]) ? $data["color"]["general"][0]["color"] : "#cccccc", "disabled" => true];
			$colors["general"][1] = ["name" => "Podrzędny", "color" => "#cccccc", "disabled" => true];
			$colors["general"][2] = ["name" => "Kolor tesktu", "color" => "#cccccc", "disabled" => true];
			$colors["general"][3] = ["name" => "Akcent", "color" => "#cccccc", "disabled" => true];
			$colors["link"] = [];
			$colors["link"][] = ["name" => "Podstawowy", "color" => "#333333", "disabled" => true];
			$colors["link"][] = ["name" => "Po najechaniu", "color" => "#000000", "disabled" => true];
            $colors["buttons"] = [];
            $colors["buttons"][] = ["name" => "Sukces", "color" => "#22c55e", "disabled" => true];
            $colors["buttons"][] = ["name" => "Ostrzezenie", "color" => "#eab308", "disabled" => true];
            $colors["buttons"][] = ["name" => "Błąd", "color" => "#ef4444", "disabled" => true];
            $colors["buttons"][] = ["name" => "Informacja", "color" => "#0ea5e9", "disabled" => true];
            $colors["buttons"][] = ["name" => "Jasny", "color" => "#e5e7eb", "disabled" => true];
            $colors["buttons"][] = ["name" => "Ciemny", "color" => "#1f2937", "disabled" => true];
			$colors["additional"] = isset($data["color"]["additional"]) ? $data["color"]["additional"] : [];
			return view('backend::layout.setting.index', ['colors' => $colors]);
		}

        public function store(Request $request) {
			set_option('layout_setting', $request->except('_token'));
			return redirect()->route('backend.layout.setting.index')->with('success', 'Ustawienia zostały zapisane');
        }
    }
