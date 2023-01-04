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
            $table->set_header('Logo', ['id' => 'image']);
            $table->set_header('Nazwa', ['id' => 'name', 'template' => '<a href="'.route('backend.product.producer.update', ['producer' => '$hash']).'" class="underline decoration-dotted whitespace-nowrap">$name</a>']);
            $table->set_action('edit', 'Edycja', route('backend.product.producer.update', ['producer' => '$hash']));
            $table->set_action('delete', 'Usuń', route('backend.product.producer.delete', ['producer' => '$hash']), ['method' => 'delete']);

            $data = [];
			$data['table'] = $table->render();

			set_title(__('module.product::core.Producers'));
			return view('module.product.backend::producer.index', $data);
        }

        public function update(Producer $producer) {
            return $producer;
        }

        public function delete(Producer $producer) {
            return $producer;
        }
    }
