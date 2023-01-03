<?php

namespace Multimedia\Multistore\Core\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
    }

	public function attributes()
	{
		return [
			'email' => mb_strtolower(__('backend::auth.E-mail adress'), 'utf-8'),
			'password' => mb_strtolower(__('backend::auth.Password'), 'utf-8'),
		];
	}
}
