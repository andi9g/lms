<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\instansiM;
use App\Models\jpM;
use App\Models\detailuserM;
use App\Models\absenpelajaranM;
use Carbon\Carbon;

class laporanC extends Controller
{
    public function laporan(Request $request)
    {
        $judul = "Laporan";
        return view("pages.laporan.laporan", [
            "judul" => $judul,
        ]);
    }

    public function cetakabsen(Request $request)
    {
        $instansi = instansiM::first();
        $tanggalabsen = $request->tanggalabsen;
        $detailuser = detailuserM::whereHas("user.posisi", function($query) {
            $query->where("status", true);
        })
        ->orderBy("namalengkap", "asc")->get();
        $jp = jpM::get();


        $tglindo = Carbon::parse($tanggalabsen)->locale("id")->isoFormat("dddd, DD MMMM YYYY");

        $pdf = Pdf::loadView("pages.laporan.pdf.absen",[
            "instansi" => $instansi,
            "tglindo" => $tglindo,
            "detailuser" => $detailuser,
            "tanggalabsen" => $tanggalabsen,
            "jp" => $jp,
        ])
        ->setPaper('a4', 'landscape');;

        return $pdf->stream("laporan.pdf");
    }
}
