<?php

	namespace Multimedia\Multistore\Core\Http\Traits;

	use Arr;

	trait useLog {

		public static function boot() {
			parent::boot();

			self::created(function ($model) {
				$after = Arr::except($model, ['updated_at', 'created_at', 'published_at', 'deleted_at']);
				$changes = [];
				foreach ($after->attributes as $key => $value) {
					$value = is_object(json_decode($value)) ? json_decode($value) : $value;
					$changes["before"][$key] = null;
					$changes["after"][$key] = $value;
				}
				$params = [];
				$params["action"] = 'created';
				$params["changes"] = $changes;
				register_user_log($model->model, $model->id, $params);
			});

			self::updated(function($model) {
				$after = Arr::except($model, ['updated_at', 'created_at', 'published_at', 'deleted_at']);
				$before = $model->original;
				$changes = [];
				foreach ($after->attributes as $key => $after_value) {
					$after_value = is_object(json_decode($after_value)) ? json_decode($after_value) : $after_value;
					$before_value = isset($before[$key]) ? $before[$key] : null;
					$before_value = is_object(json_decode($before_value)) ? json_decode($before_value) : $before_value;

					$changes["before"][$key] = $before_value;
					$changes["after"][$key] = $after_value;
				}
				$params = [];
				$params["action"] = 'updated';
				$params["changes"] = $changes;
				register_user_log($model->model, $model->id, $params);
			});

			self::deleted(function ($model) {
				$params = [];
				$params["action"] = 'deleted';
				register_user_log($model->model, $model->id, $params);
			});
		}
	}
