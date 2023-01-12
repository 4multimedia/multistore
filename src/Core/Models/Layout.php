<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Multimedia\Multistore\Core\Http\Traits\useHash;

class Layout extends Model
{
	use SoftDeletes, useHash;

	public $table = "layout";
	public $primaryKey = "id_layout";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'id_media_directory_parent',
        'name',
		'params'
    ];

	protected $casts = [
		'content' => 'array'
	];
}
