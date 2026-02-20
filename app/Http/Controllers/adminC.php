<?php

namespace App\Http\Controllers;

use App\Models\instansiM;
use Illuminate\Http\Request;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
