<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\instansiM;
use App\Models\kelasM;
use App\Models\jurusanM;
use App\Models\mapelM;
use App\Models\ruangM;
use App\Models\jpM;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Locked;

class MasterdataLive extends Component
{

    #[Locked]
    public $idinstansi, $idsemester;
    
    public $namakelas, $namajurusan, $namamapel, $namajp;

    public $search;
    public $dataruang=[];
    public $namaruang=[];

    public function mount($idinstansi, $idsemester)
    {
        $this->idinstansi = $idinstansi;
        $this->idsemester = $idsemester;
    }

    public function render()
    {
        $kelas = kelasM::where("idinstansi" , $this->idinstansi)->get();
        $jurusan = jurusanM::where("idinstansi" , $this->idinstansi)->get();
        $ruang = ruangM::where("idinstansi" , $this->idinstansi)->get();
        $mapel = mapelM::where("idinstansi" , $this->idinstansi)->get();
        $jp = jpM::where("idinstansi" , $this->idinstansi)->get();

        $isiruang = $ruang->pluck("namaruang")->toArray();

        foreach ($kelas as $kel) {
            foreach ($jurusan as $jur) {
                $value = $kel->namakelas." ".$jur->namajurusan;
                if (!in_array($value, $this->dataruang) && !in_array($value, $isiruang) ) {
                    $this->dataruang[] = $kel->namakelas." ".$jur->namajurusan;
                }
            }
        }
        
        
        return view('livewire.masterdata-live', [
            "kelas" => $kelas,
            "jurusan" => $jurusan,
            "ruang" => $ruang,
            "mapel" => $mapel,
            "jp" => $jp,
        ]);
    }

    public function tambah_kelas()
    {
        $this->validate([
            "namakelas" => "required",
        ]);

        kelasM::create([
            "idinstansi" => $this->idinstansi,
            "namakelas" => $this->namakelas,
        ]);

        $this->reset("namakelas");
        \Flux::modals()->close();
        
        LivewireAlert::title('Success')->success()->show();
    }
    
    public function hapus_kelas($idkelas)
    {
        LivewireAlert::title('Delete Data')
        ->text('Are you sure you want to delete this data?')
        ->asConfirm()
        ->onConfirm('deleteItemKelas', ['idkelas' => $idkelas])
        ->show();
    }
    
    
    public function deleteItemKelas($array)
    {
        $idkelas = $array['idkelas'];
        $idinstansi = $this->idinstansi;

        kelasM::where(["idkelas" => $idkelas, "idinstansi" => $idinstansi])->delete();

        \Flux::toast(variant: 'success', heading: 'Success!', text:"Data berhasil dihapus!.");

    }




    //jurusan
    public function tambah_jurusan()
    {
        $this->validate([
            "namajurusan" => "required",
        ]);

        jurusanM::create([
            "idinstansi" => $this->idinstansi,
            "namajurusan" => $this->namajurusan,
        ]);

        $this->reset("namajurusan");
        \Flux::modals()->close();
        
        LivewireAlert::title('Success')->success()->show();
    }
    
    public function hapus_jurusan($idjurusan)
    {
        LivewireAlert::title('Delete Data')
        ->text('Are you sure you want to delete this data?')
        ->asConfirm()
        ->onConfirm('deleteItemjurusan', ['idjurusan' => $idjurusan])
        ->show();
    }
    
    
    public function deleteItemjurusan($array)
    {
        $idjurusan = $array['idjurusan'];
        $idinstansi = $this->idinstansi;

        jurusanM::where(["idjurusan" => $idjurusan, "idinstansi" => $idinstansi])->delete();

        \Flux::toast(variant: 'success', heading: 'Success!', text:"Data berhasil dihapus!.");

    }


    //mapel
    public function tambah_mapel()
    {
        $this->validate([
            "namamapel" => "required",
        ]);

        mapelM::create([
            "idinstansi" => $this->idinstansi,
            "namamapel" => $this->namamapel,
        ]);

        $this->reset("namamapel");
        \Flux::modals()->close();
        
        LivewireAlert::title('Success')->success()->show();
    }
    
    public function hapus_mapel($idmapel)
    {
        LivewireAlert::title('Delete Data')
        ->text('Are you sure you want to delete this data?')
        ->asConfirm()
        ->onConfirm('deleteItemmapel', ['idmapel' => $idmapel])
        ->show();
    }
    
    
    public function deleteItemmapel($array)
    {
        $idmapel = $array['idmapel'];
        $idinstansi = $this->idinstansi;

        mapelM::where(["idmapel" => $idmapel, "idinstansi" => $idinstansi])->delete();

        \Flux::toast(variant: 'success', heading: 'Success!', text:"Data berhasil dihapus!.");

    }


    //ruang
    public function tambah_ruang()
    {
        $this->validate([
            "namaruang" => "required|array",
        ]);

        $namaruang = $this->namaruang;

        foreach ($namaruang as $ruang) {
            ruangM::create([
                "idinstansi" => $this->idinstansi,
                "namaruang" => $ruang,
            ]);
        }

        $this->reset(["namaruang", "dataruang"]);
        \Flux::modals()->close();
        
        LivewireAlert::title('Success')->success()->show();
    }
    
    public function hapus_ruang($idruang)
    {
        LivewireAlert::title('Delete Data')
        ->text('Are you sure you want to delete this data?')
        ->asConfirm()
        ->onConfirm('deleteItemruang', ['idruang' => $idruang])
        ->show();
    }
    
    
    public function deleteItemruang($array)
    {
        $idruang = $array['idruang'];
        $idinstansi = $this->idinstansi;

        ruangM::where(["idruang" => $idruang, "idinstansi" => $idinstansi])->delete();

        \Flux::toast(variant: 'success', heading: 'Success!', text:"Data berhasil dihapus!.");

    }


    //jp
    public function tambah_jp()
    {
        $this->validate([
            "namajp" => "required",
        ]);

        jpM::create([
            "idinstansi" => $this->idinstansi,
            "namajp" => $this->namajp,
        ]);

        $this->reset("namajp");
        \Flux::modals()->close();
        
        LivewireAlert::title('Success')->success()->show();
    }
    
    public function hapus_jp($idjp)
    {
        LivewireAlert::title('Delete Data')
        ->text('Are you sure you want to delete this data?')
        ->asConfirm()
        ->onConfirm('deleteItemjp', ['idjp' => $idjp])
        ->show();
    }
    
    
    public function deleteItemjp($array)
    {
        $idjp = $array['idjp'];
        $idinstansi = $this->idinstansi;

        jpM::where(["idjp" => $idjp, "idinstansi" => $idinstansi])->delete();

        \Flux::toast(variant: 'success', heading: 'Success!', text:"Data berhasil dihapus!.");

    }


    public function createTag()
    {
        $this->dataruang[] = $this->search;
        $this->namaruang[] = $this->search;
    }
}
