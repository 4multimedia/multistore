<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Api\Content;

	use App\Modules\Product\Http\Models\Category;
	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Controllers\Controller;
	use Illuminate\Support\Str;

    class CategoryController extends Controller
    {
		public function store(Request $request) {

			return Category::create([
				'id_product_category_parent' => $request->id_parent,
				'name' => ['pl' => $request->name],
				'slug' => ['pl' => Str::slug($request->name)]
			]);
		}
    }
