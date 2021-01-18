<?php

namespace App\Http\Controllers;

use App\Models\LibroDiario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LibroDiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //libros diarios del usuario actual
    {
       // $librod=LibroDiario::where('user_id',auth()->user()->id)->get();
       return  DB::table('libro_diarios as ld')->join('empresas as e', 'e.id', '=', 'ld.empresa_id')
       ->join('users as u','u.id','=','ld.user_id')
       ->select('e.nombre','e.rubro','ld.id as id')
        ->where('u.id',auth()->user()->id)->orderBy('ld.id','asc')->get();
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
        echo $request->id;
        $libro=new LibroDiario();
        $libro->user_id=auth()->user()->id;
        $libro->empresa_id=$request->id;
        $libro->save();
        return $libro;
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        foreach (LibroDiario::find($id)->registroLibroDiario as $registro) {
            $registro->delete();
        }

        LibroDiario::find($id)->delete();

    }
}
