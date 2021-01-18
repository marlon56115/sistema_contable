<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function report1($id)
    {
        $totalDebe = 0;
        $totalHaber = 0;
        $ld = DB::table('libro_diarios as ld')->join('empresas as e', 'e.id', '=', 'ld.empresa_id')
            ->join('users as u', 'u.id', '=', 'ld.user_id')
            ->join('registrolds as rld', 'rld.libro_diario_id', '=', 'ld.id')
            ->join('subcuentas as sc', 'sc.id', '=', 'rld.subcuenta_id')
            ->select('ld.id as ldId', 'rld.concepto', 'e.nombre', 'e.rubro', 'ld.id as id', 'rld.id as transaccion', 'rld.debe', 'rld.haber', 'sc.nombre as subcuenta', 'sc.id as subcuentaId')
            ->where('u.id', auth()->user()->id)->where('ld.id', $id)->orderBy('sc.id','asc')->get();

        if (count($ld) != 0) {
            foreach ($ld as $l) {
                $totalDebe += $l->debe;
                $totalHaber += $l->haber;
            }
            //return $ld;
            //return view('reports/report1',compact('ld','totalDebe','totalHaber'));
            $options = new Options();
            $options->setIsHtml5ParserEnabled(true);
            $options->set('defaultPaperSize' ,"A4");
            $options->set('defaultPaperOrientation' ,"landscape");
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml(view('reports/report1', compact('ld', 'totalDebe', 'totalHaber')));
            // Render the HTML as PDF
            $dompdf->render();
            // Output the generated PDF to Browser
            return $dompdf->stream();
        } else {
            return 'no existe';
        }
    }
}
