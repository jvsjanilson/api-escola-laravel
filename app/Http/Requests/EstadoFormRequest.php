<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadoFormRequest extends FormRequest
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
        return [
            'uf' => ['required', 'max:2', 'min:2', 'unique:estados,uf,except,id '],
            'nome' => ['required', 'max:60', 'min:2']
        ];
    }

    public function attributes()
    {
        return [
            'uf' => 'UF',
            'nome' => 'Nome'
        ];
    }
}
