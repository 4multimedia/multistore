<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Multimedia\Multistore\Core\Http\Traits\useHash;
use Multimedia\Multistore\Core\Http\Traits\usePath;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Multimedia\Multistore\Core\Http\Traits\UseImage;

class MediaFiles extends Model
{
	use SoftDeletes, useHash, UseImage;

	public $table = "media_files";
	public $primaryKey = "id_media_files";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'id_media_directory',
        'name',
		'type',
		'extension',
		'size',
		'params'
    ];

	protected $casts = [
		'params' => 'array'
	];

	public function convertUploadedFileToHumanReadable($size, $precision = 2)
    {
        if ($size > 0 ) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }

	public function getHumanSizeAttribute() {
		return $this->convertUploadedFileToHumanReadable($this->size, 2);
	}

	public function path(): Attribute {
		$params = $this->params;

		return Attribute::make(
			get: fn () => $params["path"],
		);
	}

	public function paths(): Attribute {
		$sizes = $this->sizes();
		$path = asset($this->path);

		$sizes_path = [];
		$sizes_path['full'] = $path;
		if ($sizes) {
			foreach($sizes as $key => $size) {
				$sizes_path[$key] = media()->get_resize_name($path, $key);
			}
		}

		return Attribute::make(
			get: fn () => $sizes_path,
		);
	}
}
