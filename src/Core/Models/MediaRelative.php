<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\Model;

class MediaRelative extends Model
{
	public $table = "media_relative";

	public function file() {
		return $this->hasOne(MediaFiles::class, 'id_media_files', 'id_media_files');
	}

    public $fillable = [
		'id_media_files',
		'id_record',
		'name',
		'type',
		'table',
		'position',
		'active'
	];
}
