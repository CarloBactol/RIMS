<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        // return [
        //     'email' => ['required|email|unique:users,email'],
        //     'name' => 'required|string',
        // ];


        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name' => 'required',
                        'email' => 'required|email|unique:users',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required',
                        // 'email' => "unique:users,email,$this->id,id",

                        //below way will only work in Laravel ^5.5
                        // 'email' => Rule::unique('users')->ignore($this->id),

                        //Sometimes you dont have id in $this object
                        //then you can use route method to get object of model
                        //and then get the id or slug whatever you want like below:
                        // $this->route()->user_info is the parameterRoute
                        'email' => Rule::unique('users')->ignore($this->route()->user_info),
                    ];
                }
            default:
                break;
        }
    }
}
