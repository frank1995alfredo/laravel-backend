<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tblproducto;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto = DB::table('tblproducto')->join('tblcategoria', 'tblcategoria.id', '=', 'tblproducto.idcategoria')
        ->select('tblproducto.id', 'tblproducto.idcategoria','tblcategoria.descripcion as categoria', 'tblproducto.descripcion as producto',
        'tblproducto.precio', 'tblproducto.cantidad', 
         DB::raw('ROUND((tblproducto.precio*tblproducto.cantidad), 3) as total'))->get();

        return response()->json([
            'res' => 'ok',
            'data' => $producto
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
        tblproducto::create($request->all());

        $producto = DB::table('tblproducto')->join('tblcategoria', 'tblcategoria.id', '=', 'tblproducto.idcategoria')
        ->select('tblproducto.id', 'tblproducto.idcategoria','tblcategoria.descripcion as categoria', 'tblproducto.descripcion as producto',
        'tblproducto.precio', 'tblproducto.cantidad', 
         DB::raw('ROUND((tblproducto.precio*tblproducto.cantidad), 3) as total'))->latest('id')->first();

        return response()->json([
            'res' => 'ok',
            'data' => $producto
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
        $producto = tblproducto::find($id);
        if (!$producto) {
            return response()->json([
                'res' => false,
                'data' => 'No existe este producto'
            ], 422);
        } else {
            return response()->json([
                'res' => 'ok',
                'data' => $producto
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
        
        $producto = tblproducto::find($id);
        
        $idcategoria = $request->input('idcategoria');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $cantidad = $request->input('cantidad');

        if (!$descripcion or !$idcategoria or !$precio or !$cantidad) {
            return response()->json([
                'res' => false,
                'data' => 'Ingrese todos los datos'
            ], 422);
        }

        $producto->idcategoria = $idcategoria;
        $producto->descripcion = $descripcion;
        $producto->precio = $precio;
        $producto->cantidad = $cantidad;
        $producto->save();

        $producto = DB::table('tblproducto')->join('tblcategoria', 'tblcategoria.id', '=', 'tblproducto.idcategoria')
        ->select('tblproducto.id', 'tblproducto.idcategoria','tblcategoria.descripcion as categoria', 'tblproducto.descripcion as producto',
        'tblproducto.precio', 'tblproducto.cantidad', 
         DB::raw('ROUND((tblproducto.precio*tblproducto.cantidad), 3) as total'))->where('tblproducto.id', '=', $id)
         ->get();
   
        return response()->json([
            'res' => 'ok',
            'data' => $producto
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
        tblproducto::where('id', '=', $id)->delete();

        return response()->json([
            'res' => 'ok',
            'data' => 'Registro eliminado correctamene'
        ], 200);
    }
}
