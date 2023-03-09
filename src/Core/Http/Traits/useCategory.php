<?php

namespace Multimedia\Multistore\Core\Http\Traits;

use Illuminate\Support\Facades\DB;
use Multimedia\Multistore\Core\Http\Collection\TreeCollection;
use Multimedia\Multistore\Core\Models\RelationRecordToCategory;

trait UseCategory {
	public static function bootUseCategory() {
		static::saved(function($model) {
			$id = $model->id;

			$self = new static;
			$table = $self->tableCategory;

			$request = request();
			if ($request->id_category_main) {
				$item = RelationRecordToCategory::where('id_record', $id)->where('table_name', $table)->where('main', 1)->first();
				if ($item) {
					DB::table('relation_record_to_category')->where('id_record', $id)->where('table_name', $table)->where('main', 1)->update(['id_category' => $request->id_category_main]);
				} else {
					RelationRecordToCategory::updateOrCreate(['id_record' => $id, 'table_name' => $table, 'main' => 1], ['id_category' => $request->id_category_main]);
				}
			}
		});
	}

	public function getCategoryMainNameAttribute() {
        if (!$this->tableCategory) { throw new \Exception('No public variable $tableCategory [Err 230]', 500); }
        if (!$this->tablePrimaryKey) { throw new \Exception('No public variable $tablePrimaryKey [Err 231]', 500); }

		if ($this->id_category_main && $this->tableCategory) {
			$item = DB::table($this->tableCategory)->where($this->tablePrimaryKey, $this->id_category_main)->first();
			if ($item) {
				$name = json_decode($item->name);
				return isset($name->pl) ? $name->pl : null;
			}
		}
	}

	public function getCategoryMainAttribute() {
        if (!$this->tableCategory) { throw new \Exception('No public variable $tableCategory [Err 232]', 500); }
		return RelationRecordToCategory::where('id_record', $this->{$this->primaryKey})->where('main', 1)->where('table_name', $this->tableCategory)->first();
	}

	public function getIdCategoryMainAttribute() {
		$category_main = $this->category_main;
		return $category_main ? $category_main->id_category : null;
	}

	public function getPathCategoryMainAttribute() {
		return path_category('product_category', 'id_product_category', $this->id_category_main);
	}

    public function newCollection(array $models = []) {
        return new TreeCollection($models);
    }

	public function getPathCategoryStringAttribute() {
        if (!$this->tableCategory) { throw new \Exception('No public variable $tableCategory [Err 230]', 500); }
        if (!$this->tablePrimaryKey) { throw new \Exception('No public variable $tablePrimaryKey [Err 231]', 500); }

        if ($this->id_category_main) {
		    $categories = path_category($this->tableCategory, $this->tablePrimaryKey, $this->id_category_main);
            return implode(" / ", $categories);
        }
        return null;
	}

	public function getPathCategoryRouteAttribute() {
		return path_category($this->tableCategory, $this->tablePrimaryKey, $this->id_product_category, 'slug');
	}
}
