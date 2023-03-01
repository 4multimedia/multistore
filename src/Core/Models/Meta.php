<?php

namespace Multimedia\Multistore\Core\Models;

use Multimedia\Multistore\Core\Http\Traits\useHash;

class Meta extends Model
{
	use useHash;

	public $table = "meta";
	public $primaryKey = "id_meta";

    protected $fillable = [
		'id_record',
        'table_name',
		'id_record',
		'title',
		'meta',
    ];

    protected $casts = [
        'title' => 'array',
        'meta' => 'array'
    ];
}
