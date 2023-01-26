<?php

namespace Multimedia\Multistore\Core\Models;

class Navigation extends Model
{
	public $table = "navigation";
	public $primaryKey = "id_navigation";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'id_navigation_parent',
        'route',
		'id_record',
		'module',
    ];
}
