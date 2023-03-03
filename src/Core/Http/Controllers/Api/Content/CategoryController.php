<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Api\Content;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Controllers\Controller;
	use Illuminate\Support\Str;
	use Multimedia\Product\Models\ProductCategory;

    class CategoryController extends Controller
    {
        public function index(Request $request) {
            return ProductCategory::where('id_product_category_parent', $request->id_parent == 'null' ? NULL : $request->id_parent)->get()->toTree();
        }

		public function store(Request $request) {
			return ProductCategory::create([
				'id_product_category_parent' => $request->id_parent,
				'name' => ['pl' => $request->name],
				'slug' => $request->name
			]);
		}
    }
