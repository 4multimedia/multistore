<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	public $table = "user_role";
	public $primaryKey = "id_user_role";

    public $casts = [
        'area' => 'array',
		'name' => 'array'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'area',
		'system'
    ];
}
