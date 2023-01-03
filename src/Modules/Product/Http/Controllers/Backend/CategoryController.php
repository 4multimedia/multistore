<?php

    namespace App\Modules\Product\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;

    class CategoryController extends Controller {
        public function index() {
			set_title(__('module.product::core.Categories'));
			add_action_header(__('module.product::core.Create a category'));
			return view('module.product.backend::category.index');
        }
    }
