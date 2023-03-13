<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Setting;

    use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Classes\Table;
	use Multimedia\Multistore\Core\Models\Dictionary;

    class DictionaryController extends Controller {

		public function index(Request $request) {
			$data = [];
			$data["group"] = $request->group;
			$data["title"] = get_dictionary_name($data["group"]);
			set_title('Słownik - '.$data["title"]);
			add_action_header('Ustawienia', route('backend.dictionary.setting', ['group' => $data["group"]]));
			add_action_header('Dodaj pozycję', route('backend.dictionary.create', ['group' => $data["group"]]));

			$id_dictionary_parent = get_dictionary_id($data["group"]);
			$table = new Table('dictionary', [
				'query' => Dictionary::where('id_dictionary_parent', $id_dictionary_parent)->paginate(30)
			]);

            $table->set_header('ID', ['id' => 'id', 'headerClass' => 'w-16']);
            $table->set_header('Nazwa', ['id' => 'name', 'template' => '<a href="'.route('backend.dictionary.update', ['dictionary' => '$hash']).'" class="underline decoration-dotted whitespace-nowrap font-medium">$name</a>']);
            $table->set_action('edit', 'Edycja', route('backend.dictionary.update', ['dictionary' => '$hash']));
            $table->set_action('delete', 'Usuń', route('backend.dictionary.delete', ['dictionary' => '$hash']), ['method' => 'delete']);

			$data['table'] = $table->render();

			return view('backend::setting.dictionary.index', $data);
		}

		public function create(Request $request) {
			$data = [];
			$data["group"] = $request->group;
			$data["title"] = 'Dodaj pozycję do słownika - '.get_dictionary_name($data["group"]);
			return view('backend::setting.dictionary.form', $data);
		}

		public function store(Request $request) {
			$group = $request->group;

			$id_dictionary_parent = get_dictionary_id($group);
			Dictionary::create([
				'id_dictionary_parent' => $id_dictionary_parent,
				'name' => $request->name,
				'options' => $request->except('_token', 'name')
			]);

			return redirect()->route('backend.dictionary', ['group' => $group]);
		}

		public function update(Dictionary $dictionary) {
			$data = [];
			$data["group"] = $dictionary->group;
			$data["title"] = 'Dodaj pozycję do słownika - '.$dictionary->parent->name;
			$data["cols"] = $dictionary->parent->options["cols"] ?? [];
            $data["dictionary"] = $dictionary;
			return view('backend::setting.dictionary.form', $data);
		}

        public function restore(Dictionary $dictionary, Request $request) {
			$options = json_merge($dictionary->options, $request->except('_token', 'name'));

			$dictionary->update([
				'name' => $request->name,
				'options' => $options
			]);

			return redirect()->route('backend.dictionary', ['group' => $dictionary->parent->group]);
		}

        public function delete(Dictionary $dictionary) {
			$dictionary->delete();
			return redirect()->route('backend.dictionary', ['group' => $dictionary->parent->group]);
		}

		public function setting(Request $request) {
			$data = [];
			$data["group"] = $request->group;
			$data["dictionary"] = get_dictionary_by_group($data["group"]);
			$data["dictionary_cols"] = $data["dictionary"]->options["cols"] ?? [];
			$primary = [['id' => 'position', 'name' => 'Własna kolejność'], ['id' => 'name', 'name' => 'Nazwa']];
			$data["cols"] = array_merge($primary, $data["dictionary_cols"]);
			$data["title"] = 'Ustawienie słownika - '.get_dictionary_name($data["group"]);
			return view('backend::setting.dictionary.setting', $data);
		}

		public function storeSetting(Request $request) {
			$group = $request->group;
			$id_dictionary = get_dictionary_id($group);
			$dictionary = Dictionary::where('id_dictionary', $id_dictionary)->first();
			$options = json_merge($dictionary->options, $request->except('_token', '_image'));

			$dictionary->update(['options' => $options]);

			return redirect()->route('backend.dictionary.setting', ['group' => $group]);
		}
	}
