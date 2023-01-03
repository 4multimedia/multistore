<?php

    namespace App\Modules\Product\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use App\Modules\Product\Http\Models\Producer;
    use Multimedia\Multistore\Core\Http\Classes\Table;

    class ProducerController extends Controller {
        public function index() {

			$table = new Table('producers', [
				'query' => Producer::paginate(15)
			]);

            $table->set_header('ID', ['id' => 'id', 'headerClass' => 'w-16']);
            $table->set_header('Nazwa', ['id' => 'name', 'template' => '<a href="'.route('backend.product.category.update', ['category' => '$hash']).'" class="underline decoration-dotted whitespace-nowrap">$name</a>']);
            $table->set_action('edit', 'Edycja', route('backend.product.category.update', ['category' => '$hash']));
            $table->set_action('delete', 'Usuń', route('backend.product.category.delete', ['category' => '$hash']));

            $data = [];
			$data['table'] = $table->render();

			set_title(__('module.product::core.Producers'));
			return view('module.product.backend::producer.index', $data);
        }
    }
