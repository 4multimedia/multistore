<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Multimedia\Multistore\Core\Http\Traits\useHash;
use Multimedia\Multistore\Core\Http\Traits\useLog;
use Multimedia\Multistore\Core\Http\Collection\TreeCollection;

class Page extends Model
{
	use SoftDeletes, useHash, useLog;

	public $table = "page";
	public $primaryKey = "id_page";

    public $appends = ['id', 'hash'];

	public $fillable = [
		'id_page_parent',
		'published_at',
		'position',
		'name',
		'slug',
		'excrept',
		'description'
	];

	public $casts = [
		'name' => 'array',
		'slug' => 'array',
		'excrept' => 'array',
		'description' => 'array'
	];

    public function newCollection(array $models = []) {
        return new TreeCollection($models);
    }

	protected function name(): Attribute {
		return Attribute::make(
			get: fn ($value) => $this->get_language_value($value),
		);
	}

	protected function description(): Attribute {
		return Attribute::make(
			get: fn ($value) => $this->get_language_value($value),
		);
	}

}
