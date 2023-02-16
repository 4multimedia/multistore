<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Multimedia\Multistore\Core\Http\Traits\useHash;

class Dictionary extends Model
{
	use SoftDeletes, useHash;

	public $table = "dictionary";
	public $primaryKey = "id_dictionary";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'id_dictionary_parent',
        'name',
		'options'
    ];

	protected $casts = [
		'name' => 'array',
		'options' => 'array'
	];
}
