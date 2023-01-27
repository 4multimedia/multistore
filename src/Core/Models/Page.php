<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Multimedia\Multistore\Core\Http\Traits\useHash;

class Page extends Model
{
	use SoftDeletes, useHash;

	public $table = "page";
	public $primaryKey = "id_page";

}
