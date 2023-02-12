<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Content;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Multimedia\Multistore\Core\Http\Classes\Table;
    use Multimedia\Multistore\Core\Models\Navigation;

    class NavigationController extends Controller
    {
        public function index() {
			set_title(__('backend::navigation.title'));
            add_action_header(__('backend::navigation.create'), route('backend.navigation.create'));

            $table = new Table('navigation', [
				'query' => Navigation::whereNull('id_navigation_parent')->paginate(15)
			]);

            $table->set_header('ID', ['id' => 'id', 'headerClass' => 'w-16']);
            $table->set_header('Nazwa', ['id' => 'name', 'template' => '<a href="'.route('backend.navigation.items', ['hash' => '$hash']).'" class="underline decoration-dotted whitespace-nowrap">$name</a>']);
            $table->set_action('settings', 'Ustawienia', route('backend.navigation.update', ['hash' => '$hash']), ['icon' => 'cog']);
            $table->set_action('items', 'Pozycje', route('backend.navigation.items', ['hash' => '$hash']), ['icon' => 'list-plus']);
            $table->set_action('delete', 'Usuń', route('backend.navigation.delete', ['hash' => '$hash']), ['method' => 'delete']);

            $data = [];
			$data['table'] = $table->render();

			return view('backend::content.navigation.index', $data);
		}

        public function items(Navigation $hash) {
			set_title(__('backend::navigation.title'));
            $data["navigation"] = $hash;
            $data["array"] = do_action('add_to_backend_navigation');
			return view('backend::content.navigation.items', $data);
		}

        public function create() {
            set_title(__('backend::navigation.create'));
            return view('backend::content.navigation.create');
        }

        public function store(Request $request) {
            Navigation::create([
                'label' => ['pl' => $request->name],
                'params' => $request->params
            ]);
            return redirect()->route('backend.navigation');
        }

        public function delete(Navigation $hash) {
			$hash->delete();
			return redirect()->route('backend.navigation');
		}
    }
