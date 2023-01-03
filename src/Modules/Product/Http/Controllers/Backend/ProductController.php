<?php

    namespace App\Modules\Product\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;

    class ProductController extends Controller {
        public function index() {
			set_title('Produkty');
			add_action_header('Dodaj produkt');
			return view('module.product.backend::product.index');
        }
    }
