<?php

	namespace Multimedia\Multistore\Core\Models;

	use Illuminate\Database\Eloquent\Model as BaseModel;

	class Model extends BaseModel {

		public $appends = ['hash'];

		public function get_language_value($value, $lang = null, $default = null) {
			if ($value) {
				if ($lang === null) {
					$lang = app()->getLocale();
				}
				if (gettype($value) === 'string') {
					$value = json_decode($value);
				} else {
					$value = json_decode(json_encode($value));
				}
				if (isset($value->$lang)) {
					return $value->$lang;
				}
				else if ($default !== null) {
					if (isset($value->$default)) {
						return $value->$default;
					}
				}
				return null;
			}
			return null;
		}
	}
