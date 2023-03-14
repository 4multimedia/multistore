<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\Model;

class MediaRelative extends Model
{
	public $table = "media_relative";

	public function file() {
		return $this->hasOne(MediaFiles::class, 'id_media_files', 'id_media_files');
	}

	public $casts = [
		'alt' => 'array'
	];

    public $fillable = [
		'id_media_files',
		'id_record',
		'alt',
		'type',
		'table',
		'position',
		'active'
	];
}
