<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\posisiM;
use Locked;


class PenggunaLive extends Component
{
    use WithPagination;
    
    #[Locked]
    public $idinstansi;
    
    public $posisi = [];
    public $status = [];
    public $search = '';
    
    public function updateSearch()
    {
        $this->resetPage();
    }

    public function mount($idinstansi)
    {
        $user = User::get();
        foreach ($user as $item) {
            $this->posisi[$item->iduser] = $item->posisi->posisi;
            $this->status[$item->iduser] = $item->posisi->status;
        }
        $this->idinstansi = $idinstansi;
    }

    public function render()
    {
        
        $user = User::when($this->search, function($query, $key) {
            $query->where(function($query2) use ($key) {
                $query2->where('name', 'like', "$key%")
                ->orWhere('email', 'like', '%'.$key.'%');
            });
        })
        ->paginate(15);

        $user->appends(['search' => $this->search, 'limit']);

        return view('livewire.pengguna-live', [
            "user" => $user,
        ]);
    }

    public function updatePosisi($iduser)
    {
        $posisi = posisiM::where('iduser', $iduser)
        ->update([
            'posisi' => $this->posisi[$iduser]
        ]);

        $this->posisi[$iduser] = $this->posisi[$iduser]; 

        // dd($this->posisi[$iduser]);
        \Flux::toast(variant: 'success', heading: 'Success!', text:"Posisi diupdate!.");
    }


    public function tidakaktif($iduser)
    {
        $status = 1;
        
    }
    public function aktif($status, $iduser)
    {
        $status = ($status==1)?0:1;

        $keterangan = ($status==1)?"Aktif.":"Tidak Aktif.";
        $user = User::findOrFail($iduser);
        
        posisiM::updateOrCreate([
            "iduser" => $iduser
        ], [
            "status" => $status,
        ]);

        $this->status[$iduser] = $status;

        \Flux::toast(variant: 'success', heading: 'Success!', text:"Status ".$user->name." ".$keterangan);
        
    }




}
