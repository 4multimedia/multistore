<?php

namespace Multimedia\Multistore\Core\Http\Traits;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait useImage {
	public function image(): Attribute {
		return Attribute::make(
			get: fn () => $this->{$this->primaryKey}
		);
	}

	public function images(): Attribute {
		return Attribute::make(
			get: fn () => $this->getTable()
		);
	}
}
