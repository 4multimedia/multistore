<?php

    namespace App\Modules\Product\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
	use App\Models\User;
	use Multimedia\Multistore\Core\Http\Classes\Table;

    class ProducerController extends Controller {
        public function index() {

			$table = new Table([
				'query' => User::get()
			]);
			$data = $table->render();

			die;

			set_title(__('module.product::core.Producers'));
			return view('module.product.backend::producer.index');
        }
    }
