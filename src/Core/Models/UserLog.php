<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
	public $table = "user_log";
	public $primaryKey = "id_user_log";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
		'module',
		'id_record',
		'params',
		'changes'
    ];
}
