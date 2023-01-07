<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Http\Requests\EstadoFormRequest;
use App\Models\Estado;
use Symfony\Component\HttpFoundation\Response;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::paginate();
        return response()->json($estados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadoFormRequest $request)
    {
        $data = $request->only('uf', 'nome');
        try {
            Estado::create($data);
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
        $estado = Estado::find($id);
        return response()->json($estado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstadoFormRequest $request, $id)
    {
        $data = $request->only('uf', 'nome');

        $estado = Estado::find($id);

        if (!isset($estado))
            throw new ExceptionNotFound();

        try {
            $estado->update($data);
            return response()->json(['message' => 'Registro atualizado.']);
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
        $estado = Estado::find($id);

        if (!isset($estado))
            throw new ExceptionNotFound();

        try {
            $estado->delete();
            return response()->json(['message' => 'Deletado com sucesso.']);
        } catch (\Throwable $th) {
            throw new ExceptionErrorDestroy();
        }
    }
}
