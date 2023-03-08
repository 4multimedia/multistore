<?php

    namespace Multimedia\Multistore\Core\Models;

    use Multimedia\Multistore\Core\Http\Traits\useHash;
	use Multimedia\Multistore\Core\Http\Traits\UseImage;
	use Multimedia\Multistore\Core\Http\Traits\useSlug;
	use Multimedia\Multistore\Core\Models\Model;
    use Multimedia\Multistore\Core\Http\Traits\UseCategory;

	use Illuminate\Database\Eloquent\Casts\Attribute;

    class ArticleCategory extends Model {

        use useHash, useImage, useCategory, useSlug {
            useSlug::resolveRouteBinding insteadof useHash;
            //useHash::resolveRouteBinding insteadof useSlug;
        }

        public $table = 'article_category';
        public $primaryKey = 'id_article_category';

		protected $fillable = [
			'id_article_category_parent',
			'status',
			'position',
			'name',
			'slug'
		];

		protected $casts = [
			'name' => 'array',
			'slug' => 'array'
		];

		protected function name(): Attribute {
			return Attribute::make(
				get: fn ($value) => $this->get_language_value($value),
			);
		}

        public function subcategories() {
            return $this->hasMany(ArticleCategory::class, 'id_product_category_parent', 'id_product_category');
        }

        public function items() {
            return $this->hasMany(Article::class, 'id_product_category', 'id_product_category');
        }

    }

?>
