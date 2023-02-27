<?php

	namespace Multimedia\Multistore\Core\Http\Traits;

	use Illuminate\Database\Eloquent\Casts\Attribute;
    use Illuminate\Support\Str;

	trait useSlug {

        /*protected function setTitleAttribute() {

        }*/

        protected static function boot() {
            parent::boot();

            static::creating(function ($model) {
                $model->slug = $model->name;
				register_slug_model(get_class());
            });
        }

        protected function findDuplicateSlug($lang, $_model, $name, $level) {
            $model = new $_model;
            $key_parent = $model->getKeyName()."_parent";
			$table = $model->getTable();
			has_column_in_table($table, $key_parent);
			if (has_column_in_table($table, $key_parent)) {
				$item = $model->where('slug->'.$lang, $name)->where($key_parent, $level)->first();
			} else {
            	$item = $model->where('slug->'.$lang, $name)->first();
			}
            if ($item) {
                return true;
            }
            return false;
        }

        protected function findSlug($name) {
            $models = slug()->get_models();
			$id_parent = null;
			if (request('id_parent')) {
				$id_parent = request('id_parent');
			}
            if ($models) {
                foreach($models as $model) {
                    $item = $this->findDuplicateSlug('pl', $model, $name, $id_parent);
                    if ($item) {
                        return true;
                    }
                }
            }
            return false;
        }

        protected function setSlug($name) {
			$name = trim($name);
            $name = Str::slug($name);
            $org_name = $name;
            $a = 1;

            $find = null;
            while($find !== false) {
                $find = $this->findSlug($name);
                if ($find) {
                    $name = $org_name.'-'.$a;
                    $a++;
                }
            }

            return json_encode(['pl' => $name]);
        }

		protected function slug(): Attribute {
			return Attribute::make(
				get: fn ($value) => $this->get_language_value($value),
                set: fn ($value) => $this->setSlug($value)
			);
		}

		public function resolveRouteBinding($value, $field = null) {
            return $this->where("slug->pl", $value)->firstOrFail();
        }
	}
