<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\instansiM;
use App\Models\detailuserM;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Hash;
use Locked;

class ProfilLive extends Component
{
    #[Locked]
    public $iduser;

    public $nip, $namalengkap, $email, $namainstansi, $posisi, $status;
    public $password, $password_confirmation;


    public function mount()
    {
        $this->iduser = auth()->user()->iduser;
        $this->namalengkap = auth()->user()->name;
    }

    public function render()
    {
        $user = User::findOrFail($this->iduser);
        $instansi = instansiM::firstOrFail();

        
        $this->email = $user->email;
        $this->nip = $user->detailuser?->nip?$user->detailuser->nip:"";
        $this->posisi = $user->posisi?->posisi?$user->posisi->posisi:"";
        $this->status = $user->posisi?->status?$user->posisi->status:0;
        $this->namainstansi = $instansi?->namainstansi?$instansi->namainstansi:"";

        return view('livewire.profil-live');
    }


    public function update_profil()
    {
        $this->validate([
            "nip" => "required|numeric",
            "namalengkap" => "required|string|max:255",
            "email" => "required|email",
            "namainstansi" => "required",
        ]);

        // try{
            $user = User::updateOrCreate([
                "iduser" => $this->iduser,
            ],[
                "name" => $this->namalengkap,
            ]);

            $detailuser = detailuserM::updateOrCreate([
                "iduser" => $user->iduser,
            ], [
                "namalengkap" => $user->name,
                "nip" => $this->nip
            ]);
            
            LivewireAlert::title('Success')->success()->show();

    //     }catch(\Throwable $th){
    //         \Flux::toast(variant: 'danger', heading: 'ERROR!', text:"ERROR!.");
    //     }
    }


    public function update_password()
    {
        $this->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'same:password_confirmation',
            ],
            'password_confirmation' => [
                'required',
                'string',
                'min:8',
            ],
        ], [
            'password.same' => 'Password dan konfirmasi password harus sama.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
        ]);
        
        User::updateOrCreate([
            "iduser" => $this->iduser,
        ], [
            "password" => Hash::make($this->password),
        ]);
        
        
        LivewireAlert::title('Success')->text("Password berhasil diupdate")->success()->show();
       
    }
}
