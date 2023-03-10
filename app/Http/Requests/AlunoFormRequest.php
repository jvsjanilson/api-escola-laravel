<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoFormRequest extends FormRequest
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
            'nome' => ['required'],
            'estado_id' => ['required'],
            'cidade_id' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome do Aluno',
            'estado_id' => 'Estado',
            'cidade_id' => 'Cidade',
        ];
    }
}
