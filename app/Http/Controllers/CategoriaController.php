<?php

namespace App\Http\Controllers;

use App\tblcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = tblcategoria::select('id', 'descripcion')->get();

        return response()->json([
            'res' => 'ok',
            'data' => $categoria
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        tblcategoria::create($request->all());

        $categoria = tblcategoria::latest('id')->first();

        return response()->json([
            'res' => 'ok',
            'data' => $categoria
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = tblcategoria::find($id);
        if (!$categoria) {
            return response()->json([
                'res' => false,
                'data' => 'No existe esta categoria'
            ], 422);
        } else {
            return response()->json([
                'res' => 'ok',
                'data' => $categoria
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $categoria = tblcategoria::find($id);
        $descripcion = $request->input('descripcion');

        if (!$descripcion) {
            return response()->json([
                'res' => false,
                'data' => 'Ingrese todos los datos'
            ], 422);
        }

        $categoria->descripcion = $descripcion;
        $categoria->save();

        return response()->json([
            'res' => 'ok',
            'data' => 'Datos actualizados correctamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tblcategoria::where('id', '=', $id)->delete();

        return response()->json([
            'res' => 'ok',
            'data' => 'Registro eliminado correctamene'
        ], 200);
    }
}
