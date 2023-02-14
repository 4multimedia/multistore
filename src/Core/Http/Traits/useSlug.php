<?php

	namespace Multimedia\Multistore\Core\Http\Traits;

	use Illuminate\Database\Eloquent\Casts\Attribute;

	trait useSlug {

		protected function slug(): Attribute {
			return Attribute::make(
				get: fn ($value) => $this->get_language_value($value),
			);
		}

		public function resolveRouteBinding($value, $field = null) {
            return $this->where("slug->pl", $value)->firstOrFail();
        }
	}
