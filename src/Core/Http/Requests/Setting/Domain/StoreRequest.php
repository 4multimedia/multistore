<?php

namespace Multimedia\Multistore\Core\Http\Requests\Setting\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Str;

class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'domain' => ['required', 'unique:option_domain,domain'],
        ];
    }

	public function attributes() {
		return [
			'domain' => Str::lower(__('backend::setting.Domain')),
		];
	}
}
