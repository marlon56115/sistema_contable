<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registrold;
use Illuminate\Database\Eloquent\Builder;

class BalanzaController extends Controller
{
    /**
     * Mostrar registros de una determinada fecha
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function balanza(Request $request)
    {
        if ($request->ajax()) {

            $registros = Registrold::whereMonth('fecha', '=', $request->month)
                ->whereYear('fecha', '=', $request->year)
                ->whereHas('libro', function (Builder $query) use ($request) {
                    $query->where('empresa_id', '=', $request->id);
                })
                ->orderByDesc('subcuenta_id')
                ->get();
            return $registros;
        } else {
            return view('balanza');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $mes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        //
    }
}
