<?php

namespace App\Http\Controllers;

use App\Models\instansiM;
use App\Models\semesterM;
use Illuminate\Http\Request;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class adminC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function instansi()
    {
        $judul = "Instansi";
        return view("pages.instansi", [
            "judul" => $judul,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function semester()
    {
        $instansi = instansiM::count();

        if($instansi==0) {
            return redirect("instansi")->with("warning", "Silahkan lengkapi Instansi!");
        }

        $instansi = instansiM::first();

        $judul = "Semester";
        return view("pages.semester", [
            "judul" => $judul,
            "instansi" => $instansi,
        ]);
    }

    public function masterdata()
    {
        $instansi = instansiM::count();

        if($instansi==0) {
            return redirect("instansi")->with("warning", "Silahkan lengkapi Instansi!");
        }

        $instansi = instansiM::first();
        $semester = semesterM::where("idinstansi", $instansi->idinstansi);
        if($semester->count() ==0) {
            return redirect("semester")->with("warning", "Silahkan tambah data semester!");
        }
        $semester = $semester->orderBy("idsemester", "desc")->first();

        $judul = "Data Master";
        return view("pages.masterdata", [
            "judul" => $judul,
            "instansi" => $instansi,
            "semester" => $semester,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function account(Request $request)
    {
        $instansi = instansiM::class;
        if($instansi::count()==0) {
            return redirect("instansi")->with("warning", "Silahkan lengkapi Instansi!");
        }

        $instansi = $instansi::first();
        $judul = "Akun Pengguna";
        return view("pages.account", [
            "judul" => $judul,
            "instansi" => $instansi,
        ]);


    }
    /**
     * Display the specified resource.
     */
    public function show(instansiM $instansiM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(instansiM $instansiM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, instansiM $instansiM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(instansiM $instansiM)
    {
        //
    }
}
