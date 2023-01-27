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
		'published_at'
    ];

	public function getItemsAttribute() {
		return Navigation::where('id_navigation_parent', $this->id_navigation)->orderBy('position', 'ASC')->get();
	}

	public function jsonSerialize(): mixed
	{
		return [
			'id' => $this->id,
			'items' => $this->items,
			'label' => $this->label,
			'route' => $this->route
		];
	}
}
