<?php

namespace Multimedia\Multistore\Core\Http\Traits;

use App\Modules\Product\Http\Models\ProductToCategory;
use Illuminate\Support\Facades\DB;
use Multimedia\Multistore\Core\Http\Collection\TreeCollection;

trait useCategory {
	public function category_main() {
		return $this->hasOne(ProductToCategory::class, 'id_product', 'id_product')->where('main', 1);
	}

	public function getIdCategoryMainAttribute() {
		$category_main = $this->category_main;
		return $category_main ? $category_main->id_product_category : null;
	}

	public function path_category($table = '', $primaryKey = '', $id) {
		$sql = 'SELECT * FROM (SELECT @r AS _id, (SELECT @r := '.$primaryKey.'_parent FROM `'.$table.'` WHERE '.$primaryKey.' = _id) AS '.$primaryKey.'_parent, @l := @l + 1 AS lvl FROM (SELECT @r := '.$id.', @l := 0) vars, `'.$table.'` a WHERE @r <> 0) T1 JOIN `'.$table.'` T2 ON T1._id = T2.'.$primaryKey.'  ORDER BY T1.lvl DESC';
		$items = DB::select($sql);
        $array = [];
        $key = 0;
        foreach($items as $key => $item) {
            $array[$key] = $item->name;
            $array[$key]->hash = $this->getHash($item->{$primaryKey});
        }

        $key++;
        return $array;
	}

	public function getPathCategoryMainAttribute() {
		return $this->path_category('product_category', 'id_product_category', $this->id_category_main);
	}

    public function newCollection(array $models = []) {
        return new TreeCollection($models);
    }

	public function getPathCategoryStringAttribute() {
		return '';
	}
}
