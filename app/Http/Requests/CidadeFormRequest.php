<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CidadeFormRequest extends FormRequest
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
            'nome' => ['required', 'max:120'],
            'estado_id' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome da Cidade',
            'estado_id' => 'Estado'
        ];
    }
}
