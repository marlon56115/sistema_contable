<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\LibroDiario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($error=null)
    {

        $librod=LibroDiario::where('user_id',auth()->user()->id)->get();
        return view('home',compact('librod'));

        //return LibroDiario::addSelect(['nombreEmpresa'=>Empresa::select('nombre')])->where('id',1)->get();

    }
}
