<?php

namespace App\Http\Controllers;


use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Http\Requests\AlunoFormRequest;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::paginate();
        return response()->json($alunos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlunoFormRequest $request)
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
            Aluno::create($data);
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
        $aluno = Aluno::find($id);
        return response()->json($aluno);
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

        $aluno = Aluno::find($id);

        if (!isset($aluno))
            throw new ExceptionNotFound();

        try {
            $aluno->update($data);
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
        $aluno = Aluno::find($id);

        if (!isset($aluno))
            throw new ExceptionNotFound();

        try {
            $aluno->delete();
            return response()->json(['message' => 'Removido com sucesso.']);
        } catch (\Throwable $th) {
            throw new ExceptionErrorDestroy();
        }
    }
}
