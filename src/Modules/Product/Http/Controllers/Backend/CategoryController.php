<?php

    namespace App\Modules\Product\Http\Controllers\Backend;

    use Multimedia\Multistore\Core\Http\Controllers\Data\TreeViewController;

    class CategoryController extends TreeViewController {
        public function index() {
            return view('module.product.backend::category.index');
        }


    }
