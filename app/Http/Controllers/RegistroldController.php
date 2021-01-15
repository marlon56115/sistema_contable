<?php

namespace App\Http\Controllers;

use App\Models\LibroDiario;
use App\Models\Registrold;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class RegistroldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        //$libros=LibroDiario::where('user_id',auth()->user()->id)->get();
       // return $libros;

    }

    public function registrosLibro($id){ //devuelve todos las transacciones de un libro diario con id y del usuario actual
        /* return  DB::table('libro_diarios as ld')->join('empresas as e', 'e.id', '=', 'ld.empresa_id')
        ->join('users as u','u.id','=','ld.user_id')
        ->join('libro_diario_registrold as ldr','ldr.libro_diario_id','=','ld.id')
        ->join('registrolds as rld','rld.id','=','ldr.registrold_id')
        ->join('subcuentas as sc','sc.id','=','rld.subcuenta_id')
        ->select('e.nombre','e.rubro','ld.id as libroDiario','rld.id as transaccion','rld.debe','rld.haber','sc.nombre as subcuenta')
        ->where('u.id',auth()->user()->id)->where('ld.id',$id)->get(); */

        return  DB::table('libro_diarios as ld')->join('empresas as e', 'e.id', '=', 'ld.empresa_id')
        ->join('users as u','u.id','=','ld.user_id')
        ->join('registrolds as rld','rld.libro_diario_id','=','ld.id')
        ->join('subcuentas as sc','sc.id','=','rld.subcuenta_id')
        ->select('ld.id as ldId','rld.concepto','e.nombre','e.rubro','ld.id as id','rld.id as transaccion','rld.debe','rld.haber','sc.nombre as subcuenta','sc.id as subcuentaId','sc.cuenta_id as cuentaId')
        ->where('u.id',auth()->user()->id)->where('ld.id',$id)->get();
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
        $nuevoRegistro=new Registrold();
        $nuevoRegistro->subcuenta_id=$request->subCuentaId;
        $nuevoRegistro->libro_diario_id=$request->ldID;
        $nuevoRegistro->debe=$request->debe;
        $nuevoRegistro->haber=$request->haber;
        $nuevoRegistro->concepto=$request->concepto;
        $nuevoRegistro->fecha=Carbon::now();
        $nuevoRegistro->ajuste=0;
        $nuevoRegistro->save();
        //return $nuevoRegistro;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request,$id)
    {
        $registro=Registrold::find($id);
        $registro->subcuenta_id=$request->subcuenta;
        $registro->debe=$request->debe;
        $registro->haber=$request->haber;
        $registro->concepto=$request->concepto;
        $registro->save();
        return $registro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro=Registrold::find($id);
        $registro->delete();
    }
}
