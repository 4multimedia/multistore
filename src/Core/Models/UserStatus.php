<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
	public $table = "user_status";
	public $primaryKey = "id_user_status";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];
}
