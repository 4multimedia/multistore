<?php

namespace Multimedia\Multistore\Core\Http\Traits;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait useImage {
	public function getImageAttribute() {
		$image = media()->get_images($this->table, $this->id, 1);
        return $image ? $image->file->paths["full"] : null;
	}

	public function getThumbAttribute() {
		$image = media()->get_images($this->table, $this->id, 1);
        return $image ? $image->file->paths["thumb"] : null;
	}

	public function getImages($size = 'full') {
		$array = [];
		$images = media()->get_images($this->table, $this->id);
		foreach($images as $image) {
			$array[] = [
				"src" => $image->file->paths[$size]
			];
		}
		return $array;
	}

	public function getThumbsAttribute() {
		return $this->getImages('thumb');
	}

	public function images(): Attribute {
		$id = $this->{$this->primaryKey};
		$table = $this->getTable();

		return Attribute::make(
			get: fn () => $this->getTable()
		);
	}

	public function sizes() {
		return ['thumb' => ['width' => 150, 'height' => 150]];
	}
}
