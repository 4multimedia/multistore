<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Content\Article;

    use Illuminate\Http\Request;
    use Multimedia\Multistore\Core\Http\Controllers\Controller;
    use Multimedia\Multistore\Core\Models\ArticleCategory;
    use Illuminate\Support\Str;

    class TreeCategoryController extends Controller {
        public function index(Request $request) {
            return ArticleCategory::where('id_article_category_parent', $request->id_parent == 'null' ? NULL : $request->id_parent)->get()->toTree();
        }

        public function store(Request $request) {
            return ArticleCategory::create([
				'id_article_category_parent' => $request->id_parent,
				'name' => ['pl' => $request->name]
			]);
        }
    }
