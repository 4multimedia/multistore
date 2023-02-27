<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Content;

    use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Classes\Table;
	use Multimedia\Multistore\Core\Models\Page;
	use Illuminate\Support\Str;

    class PageController extends Controller
    {
        public function index() {
			set_title(__('backend::page.title'));
            add_action_header(__('backend::page.create'), route('backend.page.create'));

			$table = new Table('page', [
				'query' => Page::paginate(15)
			]);

            $table->set_header('ID', ['id' => 'id', 'headerClass' => 'w-16']);
            $table->set_header('Nazwa', ['id' => 'name', 'template' => '<a href="'.route('backend.page.update', ['hash' => '$hash']).'" class="underline decoration-dotted whitespace-nowrap">$name</a>']);
            $table->set_action('edit', 'Edycja', route('backend.page.update', ['hash' => '$hash']));
            $table->set_action('delete', 'Usuń', route('backend.page.delete', ['hash' => '$hash']), ['method' => 'delete']);

            $data = [];
			$data['table'] = $table->render();

			return view('backend::content.page.index', $data);
		}

        public function create() {
            set_title(__('backend::page.create'));
            return view('backend::content.page.create');
        }

		public function store(Request $request) {
			Page::create([
                'id_page_parent' => $request->id_page_main,
				'name' => ['pl' => $request->name],
				'description' => ['pl' => $request->description],
				'slug' => ['pl' => Str::slug($request->name)]
			]);
			return redirect()->route('backend.page');
		}

		public function update(Page $hash) {
			set_title(__('backend::page.update'));
			$data["page"] = $hash;
			return view('backend::content.page.create', $data);
		}

		public function restore(Page $hash, Request $request) {
			$hash->update(['name' => ['pl' => $request->name], 'description' => ['pl' => $request->description]]);
			return redirect()->route('backend.page');
		}

		public function delete(Page $hash) {
			$hash->delete();
			return redirect()->route('backend.page');
		}

        public function tree(Request $request) {
            return Page::where('id_page_parent', $request->id_parent == 'null' ? NULL : $request->id_parent)->get()->toTree();
        }
    }
