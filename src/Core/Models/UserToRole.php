<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\Model;

class UserToRole extends Model
{
	public $table = "user_to_role";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'id_user_role'
    ];
}
