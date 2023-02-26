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
            });
        }

        protected function findDuplicateSlug($lang, $_model, $name, $level) {
            $model = new $_model;
            //echo $model->getKeyName();
            $model->where('slug->'.$lang, $name);
            $item = $model->first();
            if ($item) {
                return true;
            }
            return false;
        }

        protected function findSlug($name) {
            $models = slug()->get_models();
            if ($models) {
                foreach($models as $model) {
                    $item = $this->findDuplicateSlug('pl', $model, $name, null);
                    if ($item === true) {
                        return true;
                    }
                }
            }
            return false;
        }

        protected function setSlug($name) {
            $name = Str::slug($name);
            $org_name = $name;
            $a = 1;

            $find = null;
            while($find !== false) {
                echo $find = $this->findSlug($name);
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
