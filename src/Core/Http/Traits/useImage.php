<?php

namespace Multimedia\Multistore\Core\Http\Traits;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Multimedia\Multistore\Core\Models\MediaRelative;

trait UseImage {

	public static function bootUseImage() {
		static::saved(function($model) {
			$table = $model->table;
			$id_record = $model->id;
			$active = 1;

			MediaRelative::where('id_record', $id_record)->where('table', $table)->delete();

			$request = request()->all();
			if (array_key_exists('_image', $request)) {
				$images = $request['_image'];
				foreach($images as $type => $files) {
					$index = 0;
					foreach($files as $position => $file) {
						MediaRelative::create([
							'id_media_files' => $file["id"],
							'id_record' => $id_record,
							'table' => $table,
							'alt' => $file["alt"],
							'type' => $type,
							'position' => $index++,
							'active' => $active
						]);
					}
				}
			}
		});

		static::deleted(function($model) {
			$table = $model->table;
			$id_record = $model->id;

			MediaRelative::where('id_record', $id_record)->where('table', $table)->delete();
		});
	}

	public function getImageAttribute() {
		$image = media()->get_images($this->table, $this->id, 1);
        return $image ? $image->file->paths["full"] : null;
	}

	public function image($type) {
		$image = media()->get_images($this->table, $this->id, 1);
        return $image ? $image->file->paths[$type] : null;
	}

	public function getThumbAttribute() {
		$image = media()->get_images($this->table, $this->id, 1);
        return $image ? $image->file->paths["thumb"] : null;
	}

	public function getImages($size = 'full') {
		$array = [];
		$images = media()->get_images($this->table, $this->id);
		foreach($images as $image) {
			$array[] = [
				"src" => $image->file->paths[$size]
			];
		}
		return $array;
	}

	public function getThumbsAttribute() {
		return $this->getImages('thumb');
	}

	public function images(): Attribute {
		$id = $this->{$this->primaryKey};
		$table = $this->getTable();

		return Attribute::make(
			get: fn () => $this->getTable()
		);
	}

	public function allImages(): Attribute {
		$array = [];

		$images = MediaRelative::where('table', $this->table)->where('id_record', $this->id)->orderBy('position')->get();
		foreach($images as $image) {
			$array[$image->type][] = [
				'id' => $image->file->id,
				'hash' => $image->file->hash,
				'name' => $image->file->name,
				'human_size' => $image->file->human_size,
				'extension' => $image->file->extension,
				'paths' => $image->file->paths,
				'type' => 'file',
				'alt' => $image->alt
			];
		}

		return Attribute::make(
			get: fn () => $array
		);
	}

	public function sizes() {
		$sizes = get_option('setting.sizes', ['thumb' => ['width' => 150, 'height' => 150]]);
        $array = [];
        foreach($sizes as $size) {
            $array[$size["id"]] = ["width" => $size["width"], "height" => $size["height"]];
        }
        return $array;
	}
}
