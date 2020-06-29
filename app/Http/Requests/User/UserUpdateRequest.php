<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        $rules  =[

            'name' => 'required',
            'email' => 'required|unique:users,email,'. $this->user->id,
        ];

        if($this->filled('password')){

             $rules['password'] = ['required','confirmed','min:5'];


        }
        return $rules;
    }
    public function attributes()
    {
    return [
     'name'=>'nombre',
     'emial'=>'correo electronico',
     'password' =>'contraseña',
    ];
    }
}
