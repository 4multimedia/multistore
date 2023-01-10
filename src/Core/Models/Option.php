<?php

namespace Multimedia\Multistore\Core\Models;

class Option extends Model
{
	public $table = "option";
	public $primaryKey = "id_option";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'key',
        'value',
		'id_record',
		'module',
		'autoload',
    ];
}
