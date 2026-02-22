<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\mapelM;
use App\Models\kelasM;
use App\Models\jurusanM;
use App\Models\semesterM;
use App\Models\gurumapelM;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Locked;
use Session;

class MapelLive extends Component
{

    #[Locked]
    public $iduser;

    public $idmapel, $idsemester, $idkelas, $idjurusan;


    public function mount()
    {
        
        $this->iduser = auth()->user()->iduser;
    }
    public function render()
    {
        $mapel = mapelM::get();
        $kelas = kelasM::get();
        $jurusan = jurusanM::get();

        $gurumapel = gurumapelM::where(["idsemester" => Session::get("idsemester"), "iduser" => $this->iduser])->get();

        return view('livewire.mapel-live',[
            "mapel" => $mapel,
            "kelas" => $kelas,
            "jurusan" => $jurusan,
            "gurumapel" => $gurumapel,
        ]);
    }


    public function tambah_mapel()
    {
        $this->validate([
            "idkelas" => "required",
            "idmapel" => "required",
            "idjurusan" => "required",
        ],[
            "required" => "Kolom wajib di isi."
        ]);

        gurumapelM::updateOrCreate([
            "iduser" => $this->iduser,
            "idmapel" => $this->idmapel,
            "idkelas" => $this->idkelas,
            "idjurusan" => $this->idjurusan,
            "idsemester" => Session::get("idsemester"),
        ]);

        \Flux::modals()->close();
        
        LivewireAlert::title('Success')->success()->show();

    }

    
                            
    public $data = [];
    
    public function getData($idgurumapel)
    {
        $this->reset('data');

        $gurumapel = gurumapelM::where(["idgurumapel" => $idgurumapel, "iduser" => $this->iduser])->first();
        

        $this->data = [
            'idgurumapel' => $gurumapel->idgurumapel,
            'idmapel' => $gurumapel->idmapel,
            'idkelas' => $gurumapel->idkelas,
            'idjurusan' => $gurumapel->idjurusan,
        ];

        \Flux::modal('edit_gurumapel')->show();
    }

    public function update_mapel()
    {
        gurumapelM::updateOrCreate([
            "idgurumapel" => $this->data["idgurumapel"],
        ], [
            "idkelas" => $this->data["idkelas"],
            "idjurusan" => $this->data["idjurusan"],
            "idmapel" => $this->data["idmapel"],
        ]);

        \Flux::modals()->close();
        $this->reset("data");
        
        LivewireAlert::title('Success')->success()->show();
    }

    public function hapus($idgurumapel)
    {
        
        LivewireAlert::title('Delete Data')
        ->text('Are you sure you want to delete this data?')
        ->asConfirm()
        ->onConfirm('deleteItem', ['idgurumapel' => $idgurumapel])
        ->show();
        
        
    }

    public function deleteItem($array)
    {
        $idgurumapel = $array['idgurumapel'];
        
        gurumapelM::destroy($idgurumapel);

        LivewireAlert::title('Success')->success()->show();
    }
}
