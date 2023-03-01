<?php

	namespace Multimedia\Multistore\Core\Http\Traits;

	use Illuminate\Database\Eloquent\Casts\Attribute;
	use Multimedia\Multistore\Core\Models\Meta;

	trait UseMeta {

		public static function bootUseMeta() {
			static::saved(function($model) {
				$table = $model->table;
				$id = $model->id;

				$request = request();
				if (isset($request->seo)) {
					$meta = $request->seo;
					save_meta($table, $id, $meta);
				}
			});
		}

		public function getMetaAttribute() {
			return Meta::select('title', 'meta')->where('table_name', $this->getTable())->where('id_record', $this->id)->first()->toArray();
		}

		public function title(): Attribute {
			return Attribute::make(
				get: fn () => $this->meta
			);
		}
	}
