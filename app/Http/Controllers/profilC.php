<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\instansiM;

class profilC extends Controller
{
    
    public function profil(Request $request)
    {

        $instansi = instansiM::count();

        if($instansi==0) {            
            return redirect('dashboard')->with('warning', [
                'title' => 'Erorr!',
                'text'  => 'Data Instansi masih belum diinput Admin.',
                'icon'  => 'warning',
            ]);
        }


        $user = User::findOrFail(auth()->user()->iduser);
        $judul = "Profil";
        return view("pages.profil", [
            "judul" => $judul,
        ]);
    }

}
