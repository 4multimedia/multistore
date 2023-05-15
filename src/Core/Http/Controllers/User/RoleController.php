<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\User;

    use App\Http\Controllers\Controller;
	use Multimedia\Multistore\Core\Http\Classes\Table;
	use Multimedia\Multistore\Core\Models\UserRole;

    class RoleController extends Controller
    {
        public function index() {
			set_title(__('backend::page.title'));
            add_action_header(__('backend::page.create'), route('backend.page.create'));

			$table = new Table('user_role', [
				'query' => UserRole::paginate(15)
			]);

            $table->set_header('ID', ['id' => 'id', 'headerClass' => 'w-16']);
            $table->set_header('Nazwa', ['id' => 'name', 'template' => '<a href="'.route('backend.page.update', ['hash' => '$hash']).'" class="underline decoration-dotted whitespace-nowrap">$name</a>']);
            $table->set_action('edit', 'Edycja', route('backend.user.role.update', ['hash' => '$hash']));
            $table->set_action('delete', 'Usuń', route('backend.user.role.delete', ['hash' => '$hash']), ['method' => 'delete']);

            $data = [];
			$data['table'] = $table->render();

			return view('backend::user.role.index', $data);
        }

		public function create() {
			return view('backend::user.role.create');
        }
    }
