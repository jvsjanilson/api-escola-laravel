<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Http\Requests\CidadeFormRequest;
use App\Models\Cidade;
use Symfony\Component\HttpFoundation\Response;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidades = Cidade::paginate();
        return response()->json($cidades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CidadeFormRequest $request)
    {
        $data = $request->only('nome','estado_id', 'capital');
        try {
            Cidade::create($data);
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
        $cidade = Cidade::find($id);
        return response()->json($cidade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CidadeFormRequest $request, $id)
    {
        $data = $request->only('nome', 'estado_id', 'capital');

        $cidade = Cidade::find($id);

        if (!isset($cidade))
            throw new ExceptionNotFound();

        try {
            $cidade->update($data);
            return response()->json(['message' => 'Atualizado com sucesso.']);
        } catch (\Throwable $th) {
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
        $cidade = Cidade::find($id);

        if (!isset($cidade))
            throw new ExceptionNotFound();

        try {
            $cidade->delete();
            return response()->json(['message' => 'Removido com sucesso.']);
        } catch (\Throwable $th) {
            throw new ExceptionErrorDestroy();
        }
    }
}
