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
				'name' => $request->name
			]);

			return redirect()->route('backend.dictionary', ['group' => $group]);
		}

		public function update(Dictionary $dictionary) {
			$data = [];
			$data["group"] = $dictionary->group;
			$data["title"] = 'Dodaj pozycję do słownika - '.$dictionary->parent->name;
            $data["dictionary"] = $dictionary;
			return view('backend::setting.dictionary.form', $data);
		}

        public function restore(Dictionary $dictionary, Request $request) {
			$dictionary->update([
				'name' => $request->name
			]);

			return redirect()->route('backend.dictionary', ['group' => $dictionary->parent->group]);
		}

        public function delete(Dictionary $dictionary) {
			$dictionary->delete();
			return redirect()->route('backend.dictionary', ['group' => $dictionary->parent->group]);
		}
	}
