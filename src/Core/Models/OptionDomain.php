<?php

namespace Multimedia\Multistore\Core\Models;

use Multimedia\Multistore\Core\Http\Traits\useHash;

class OptionDomain extends Model
{
	use useHash;

	public $table = "option_domain";
	public $primaryKey = "id_option_domain";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'domain',
        'ssl',
		'options',
    ];

	protected $casts = [
		'options' => 'array'
	];
}
