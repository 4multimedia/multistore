<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\Model;

class RelationRecordToCategory extends Model
{
	public $table = "relation_record_to_category";
	public $primaryKey = ['id_record', 'id_category', 'table_name'];
	public $incrementing = false;

	public $fillable = [
		'id_record',
		'id_category',
		'table_name',
		'position',
		'main'
	];
}
