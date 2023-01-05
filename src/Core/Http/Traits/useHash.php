<?php

namespace Multimedia\Multistore\Core\Http\Traits;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Builder;

trait useHash {
	public function getIdAttribute() {
		return $this->{$this->primaryKey};
	}

	public function getModelAttribute() {
		$path = explode('\\', get_class($this));
		return array_pop($path);
	}

	public function getHashAttribute() {
		return $this->getHash($this->id);
	}

	public function getHash($id) {
		return Hashids::connection($this->model)->encode($id);
	}

	public function scopeByHash(Builder $query, string $hash): Builder {
        return $query->where($this->getTable().'.'.$this->getKeyName(), self::hashToId($hash, $this->model));
    }

	public static function byHash($hash): ?self {
        return self::query()->byHash($hash)->first();
    }

	public static function hashToId(string $hash, string $model = null): ?int {
        Hashids::setDefaultConnection($model);
        return isset(Hashids::decode($hash)[0]) ? Hashids::decode($hash)[0] : null;
    }

	public function resolveRouteBinding($value, $field = null) {
        return $this->where($this->primaryKey, self::hashToId($value, $this->model))->firstOrFail();
    }
}
