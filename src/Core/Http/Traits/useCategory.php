<?php

namespace Multimedia\Multistore\Core\Http\Traits;

use Illuminate\Support\Facades\DB;
use Multimedia\Multistore\Core\Http\Collection\TreeCollection;
use Multimedia\Multistore\Core\Models\RelationRecordToCategory;

trait useCategory {
	public function getCategoryMainAttribute() {
        if (!$this->tableCategory) { throw new \Exception('No public variable $tableCategory [Err 232]', 500); }
		return RelationRecordToCategory::where('id_record', $this->{$this->primaryKey})->where('main', 1)->where('table_name', $this->tableCategory)->first();
	}

	public function getIdCategoryMainAttribute() {
		$category_main = $this->category_main;
		return $category_main ? $category_main->id_category : null;
	}

	public function path_category($table = '', $primaryKey = '', $id) {
		$sql = 'SELECT * FROM (SELECT @r AS _id, (SELECT @r := '.$primaryKey.'_parent FROM `'.$table.'` WHERE '.$primaryKey.' = _id) AS '.$primaryKey.'_parent, @l := @l + 1 AS lvl FROM (SELECT @r := '.$id.', @l := 0) vars, `'.$table.'` a WHERE @r <> 0) T1 JOIN `'.$table.'` T2 ON T1._id = T2.'.$primaryKey.'  ORDER BY T1.lvl DESC';
		$items = DB::select($sql);
        $array = [];
        $key = 0;
        foreach($items as $key => $item) {
            $name = json_decode($item->name);
            $array[$key] = $name->pl;
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
        if (!$this->tableCategory) { throw new \Exception('No public variable $tableCategory [Err 230]', 500); }
        if (!$this->tablePrimaryKey) { throw new \Exception('No public variable $tablePrimaryKey [Err 231]', 500); }

        if ($this->id_category_main) {
		    $categories = $this->path_category($this->tableCategory, $this->tablePrimaryKey, $this->id_category_main);
            return implode(" / ", $categories);
        }
        return null;
	}
}
