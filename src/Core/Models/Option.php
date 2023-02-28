<?php

namespace Multimedia\Multistore\Core\Models;

use Multimedia\Multistore\Core\Http\Traits\useHash;

class Option extends Model
{
	use useHash;

	public $table = "option";
	public $primaryKey = "id_option";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'id_option_domain',
        'group',
		'key',
        'values',
		'id_record',
		'module',
		'autoload',
    ];
}
