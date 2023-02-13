<?php

namespace Multimedia\Multistore\Core\Http\Traits;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait useImage {
	public function image(): Attribute {
		return Attribute::make(
			get: fn () => media()->get_images($this->table, $this->id, 1)
		);
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
