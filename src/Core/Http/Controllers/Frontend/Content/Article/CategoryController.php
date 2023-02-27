<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Frontend\Content\Article;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Controllers\Controller;
	use Multimedia\Multistore\Core\Models\ArticleCategory;

    class CategoryController extends Controller
    {
        public function index(ArticleCategory $articleCategory) {
			$data = [];
			$data["category"] = $articleCategory;
            return render_view('frontend::content.article.category', $data);
        }
    }
