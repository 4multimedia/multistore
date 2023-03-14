<?php

namespace Multimedia\Multistore\Core\Http\Traits;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Multimedia\Multistore\Core\Models\DictionaryRelative;
use Multimedia\Multistore\Core\Models\MediaRelative;

trait UseDictionary {

	public static function bootUseDictionary() {
		static::saved(function($model) {
			$table = $model->table;
			$id_record = $model->id;

			DictionaryRelative::where('id_record', $id_record)->where('table', $table)->delete();

			$request = request()->all();
			if (array_key_exists('_dictionary', $request)) {
				save_dictionary($request["_dictionary"], $id_record, $table);
			}
		});

		static::deleted(function($model) {
			$table = $model->table;
			$id_record = $model->id;

			DictionaryRelative::where('id_record', $id_record)->where('table', $table)->delete();
		});
	}
}
