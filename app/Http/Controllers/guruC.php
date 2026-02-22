<?php

namespace App\Http\Controllers;

use App\Models\mapelM;
use App\Models\semesterM;
use App\Models\gurumapelM;
use Illuminate\Http\Request;
use Session;
use Auth;

class guruC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function mapel(Request $request)
    {
        $semester = semesterM::class;

        if($semester::count() == 0) {
            return redirect('dashboard')->with('warning', [
                'title' => 'Alert!',
                'text'  => 'Semester belum di input admin',
                'icon'  => 'warning',
            ]);
        }
        $semester = $semester::where("idsemester", Session::get("idsemester"))->first();

        $judul = "Mata Pelajaran";
        return view("pages.mapel", [
            "judul" => $judul,
            "semester" => $semester,
        ]);
    }

    public function absen(Request $request)
    {
        $gurumapel = gurumapelM::where(["iduser" => auth()->user()->iduser, "idsemester" => Session::get("idsemester")]);

        if($gurumapel->count() == 0) {
            return redirect('mapel')->with('warning', [
                'title' => 'Alert!',
                'text'  => 'Silahkan Menambahkan Mata Pelajaran Terlebih dahulu',
                'icon'  => 'warning',
            ]);
        }

        $semester = semesterM::class;

        if($semester::count() == 0) {
            return redirect('dashboard')->with('warning', [
                'title' => 'Alert!',
                'text'  => 'Semester belum di input admin',
                'icon'  => 'warning',
            ]);
        }
        $semester = $semester::where("idsemester", Session::get("idsemester"))->first();

        $judul = "Absen Pembelajaran";
        return view("pages.absen", [
            "judul" => $judul,
            "semester" => $semester,
        ]);
    }

   
}
