<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\Model;

class DictionaryRelative extends Model
{
	public $table = "dictionary_relative";
	public $timestamps = false;

	public $fillable = [
		'id_dictionary',
		'id_record',
		'table',
		'position'
	];
}
