<?php

namespace Multimedia\Multistore\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Multimedia\Multistore\Core\Http\Traits\useHash;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Dictionary extends Model
{
	use SoftDeletes, useHash;

	public $table = "dictionary";
	public $primaryKey = "id_dictionary";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'id_dictionary_parent',
        'name',
		'options'
    ];

	protected $casts = [
		'name' => 'array',
		'options' => 'array'
	];

    protected function parent(): Attribute {
        return Attribute::make(
            get: fn () => Dictionary::where('id_dictionary', $this->attributes['id_dictionary_parent'])->first(),
        );
    }

    protected function name(): Attribute {
        return Attribute::make(
            get: fn ($value) => $this->get_language_value($value),
        );
    }

    protected function names(): Attribute {
        return Attribute::make(
            get: fn () => $this->attributes['name'],
        );
    }

    protected function group(): Attribute {
        $options = $this->options;
        return Attribute::make(
            get: fn () => isset($options["group"]) ? $options["group"] : null
        );
    }
}
