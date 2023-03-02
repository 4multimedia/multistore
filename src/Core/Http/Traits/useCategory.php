<?php

namespace Multimedia\Multistore\Core\Http\Traits;

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
