<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Multimedia\Multistore\Core\Http\Traits\useHash;

class MediaDirectory extends Model
{
	use SoftDeletes, useHash;

	public $table = "media_directory";
	public $primaryKey = "id_media_directory";

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
		'params' => 'array'
	];
}
