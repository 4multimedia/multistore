<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Content\Article;

    use Illuminate\Http\Request;
    use Multimedia\Multistore\Core\Http\Controllers\Controller;
    use Multimedia\Multistore\Core\Models\ArticleCategory;

    class CategoryController extends Controller {
        public function index() {
            $data = [];
            return render_view('backend::article.category.index', $data);
        }

        public function update(ArticleCategory $category) {
            $data = [];
            $data["category"] = $category;
			return render_view('backend::article.category.index', $data);
        }

        public function restore(ArticleCategory $category, Request $request) {
            $category->update([
                'name' => ['pl' => $request->name]
            ]);
            save_dictionary($request->dictionary, $category->id, 'article_category');
        }

        public function delete(ArticleCategory $category) {
            $category->delete();
        }
    }
