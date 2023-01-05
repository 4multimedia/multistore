<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Multimedia\Multistore\Core\Http\Traits\useHash;
use Multimedia\Multistore\Core\Http\Traits\usePath;

class MediaDirectory extends Model
{
	use SoftDeletes, useHash, usePath;

	public $table = "media_directory";
	public $primaryKey = "id_media_directory";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'id_media_directory_parent',
        'name',
		'params'
    ];

	protected $casts = [
		'params' => 'array'
	];

	public function subdirectory() {
		return $this->hasMany(MediaDirectory::class, 'id_media_directory_parent', 'id_media_directory');
	}

	public function files() {
		return $this->hasMany(MediaFiles::class, 'id_media_directory', 'id_media_directory');
	}

	public function getCountSubdirectoryAttribute() {
		return $this->subdirectory->count();
	}

	public function getCountFilesAttribute() {
		return $this->files->count();
	}
}
