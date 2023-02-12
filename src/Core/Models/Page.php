<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Multimedia\Multistore\Core\Http\Traits\useHash;
use Multimedia\Multistore\Core\Http\Traits\useLog;

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

}
