<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\instansiM;

class InstansiLive extends Component
{
    use WithFileUploads;
    #[Validate('image|max:10240')] // 10MB Max
    
    public $photo, $idinstansi;
    public $namainstansi, $npsn, $alamatinstansi;

    public function render()
    {
        $instansi = instansiM::first();
        $this->idinstansi = $instansi?->idinstansi?$instansi->idinstansi:1;
        $this->namainstansi = $instansi?->namainstansi?$instansi->namainstansi:"";
        $this->npsn = $instansi?->npsn?$instansi->npsn:"";
        $this->alamatinstansi = $instansi?->alamatinstansi?$instansi->npsn:"";

        return view('livewire.instansi-live', [
            "instansi" => $instansi,
        ]);
    }

    public function removePhoto()
    {
        $this->photo->delete();
        $this->photo = null;
    }
    public function update_logo()
    {
        $this->validate([
            "photo" => "required|image"
        ]);

        $path = $this->photo->store("photos", "public");

        instansiM::updateOrCreate([
            "idinstansi" => $this->idinstansi
        ], [
            "logo" => $path
        ]);

        $this->photo = null;
        
        LivewireAlert::title('Success')->success()->show();
    }

    public function update_instansi()
    {
        $this->validate([
            "npsn" => "required|numeric",
            "namainstansi" => "required",
            "alamatinstansi" => "required",
        ]);

        instansiM::updateOrCreate([
            "idinstansi" => $this->idinstansi
        ], [
            "npsn" => $this->npsn,
            "namainstansi" => $this->namainstansi,
            "alamatinstansi" => $this->alamatinstansi,
        ]);

        $this->reset(["npsn", "namainstansi", "alamatinstansi"]);

        
        LivewireAlert::title('Success')->success()->show();

    }
}
