<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Http\Requests\ResponsavelFormRequest;
use App\Models\Responsaveis;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponsavelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Responsaveis::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResponsavelFormRequest $request)
    {
        $data = $request->only(
            'nome',
            'tipo_logradouro',
            'logradouro',
            'numero',
            'complemento',
            'cep',
            'bairro',
            'estado_id',
            'cidade_id',
            'telefone',
            'celular',
            'email',
            'status',
            'ativo',
        );

        try {
            Responsaveis::create($data);
            return response()->json(['message' => 'Registro criado.'], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            throw new ExceptionErrorCreate();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Responsaveis::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(
            'nome',
            'tipo_logradouro',
            'logradouro',
            'numero',
            'complemento',
            'cep',
            'bairro',
            'estado_id',
            'cidade_id',
            'telefone',
            'celular',
            'email',
            'status',
            'ativo',
        );


        $responsavel = Responsaveis::find($id);

        if (!isset($responsavel))
            throw new ExceptionNotFound();

        try {
            $responsavel->update($data);
            return response()->json(['message' => 'Atualizado com sucesso.']);
        } catch (\Exception $th) {
            throw new ExceptionErrorUpdate();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $responsavel = Responsaveis::find($id);

        if (!isset($responsavel))
            throw new ExceptionNotFound();

        try {
            $responsavel->delete();
            return response()->json(['message' => 'Removido com sucesso.']);
        } catch (\Throwable $th) {
            throw new ExceptionErrorDestroy();
        }
    }
}
