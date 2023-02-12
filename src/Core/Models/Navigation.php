<?php

namespace Multimedia\Multistore\Core\Models;

use Multimedia\Multistore\Core\Http\Traits\useHash;

class Navigation extends Model
{
	public $table = "navigation";
	public $primaryKey = "id_navigation";

	use useHash;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'id_navigation_parent',
        'route',
		'id_record',
		'module',
		'position',
		'published_at',
        'params',
        'label'
    ];

    protected $casts = [
        'label' => 'array',
        'params' => 'array'
    ];

	public function getItemsAttribute() {
		return Navigation::where('id_navigation_parent', $this->id_navigation)->orderBy('position', 'ASC')->get();
	}

	public function getNameAttribute() {
		if ($this->label) {
			return $this->label;
		} else {
			return $this->route;
		}
	}

	public function jsonSerialize(): mixed
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'items' => $this->items,
			'label' => $this->label,
			'route' => $this->route
		];
	}
}
