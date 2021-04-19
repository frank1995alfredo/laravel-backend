<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tblalumno;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alumno = DB::table('tblalumno')->select('id', 'nombre', 'apellido', 'edad')->get();

        return response()->json([
            'res' => 'ok',
            'data' => $alumno
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        tblalumno::create($request->all());

        $alumno = DB::table('tblalumno')->select('id', 'nombre', 'apellido', 'edad')->get();
        return response()->json([
            'res' => 'ok',
            'data' => $alumno
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = tblalumno::find($id);
        if(!$alumno){
            return response()->json([
                'res' => false,
                'data' => 'No existe esre alumno'
            ], 422);
        } else {
            return response()->json([
                'res' => 'ok',
                'data' => $alumno
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
        $alumno = tblalumno::find($id);

        $alumno_id = $request->input('id');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $edad = $request->input('edad');

        if($alumno_id == 0 or $nombre == "" or $edad == "" or $apellido == "") {
            return response()->json([
                'res' => false,
                'data' => 'Debe ingresar todos los campos'
            ], 422);
            
        } else {
            $alumno->id = $alumno_id;
            $alumno->nombre = $nombre;
            $alumno->apellido = $apellido;
            $alumno->edad = $edad;

            $alumno->save();

            return response()->json([
                'res' => 'ok',
                'data' => 'Datos actualizados correctamente'
            ], 204);
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
        tblalumno::where('id', '=', $id)->delete();

        return response()->json([
            'res' => true,
            'message' => 'Registro eliminado correctamente.'
        ], 204);
    }
}
