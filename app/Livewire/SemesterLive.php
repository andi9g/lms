<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\instansiM;
use App\Models\semesterM;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Locked;

class SemesterLive extends Component
{
    use WithPagination;
    
    public $search = '';
    
    #[Locked]
    public $idinstansi, $namainstansi;

    public $namasemester, $tahunpelajaran;

    public function mount($idinstansi)
    {
        $instansi = instansiM::findOrFail($idinstansi);
        $this->idinstansi = $instansi->idinstansi;
        $this->namainstansi = $instansi->namainstansi;
        $this->namasemester = "";
        $this->tahunpelajaran = "";
    }


    public function render()
    {
        $instansi = instansiM::first();

       
        
        
        
        $semester = semesterM::where("idinstansi", $this->idinstansi)
        ->when($this->search, function($query, $key) {
            $query->where(function($query2) use ($key) {
                $query2->where('namasemester', 'like', "$key%")
                ->orWhere('tahunpelajaran', 'like', '%'.$key.'%');
            });
        })
        ->paginate(10);

        $semester->appends(['search' => $this->search, 'limit']);

        $currentYear = now()->year;

        $tp = [];

        for ($i = -1; $i <= 0; $i++) {
            $start = $currentYear + $i;
            $end = $start + 1;

            $tp[] = "{$start}/{$end}";
        }
        
        return view('livewire.semester-live', [
            "instansi" => $instansi,
            "tp" => $tp,
            "semester" => $semester,
        ]);
    }

    public function updateSearch()
    {
        $this->resetPage();
    }


    public function simpan_semester()
    {
        $this->validate([
            "namasemester" => "required",
            "tahunpelajaran" => "required",
        ]);

        semesterM::create([
            "namasemester" => $this->namasemester,
            "tahunpelajaran" => $this->tahunpelajaran,
            "idinstansi" => $this->idinstansi,
        ]);

        $this->reset(["namasemester", "tahunpelajaran"]);

        // session()->forget("warning");
        
        LivewireAlert::title('Success')->success()->show();
    }

    public function hapus_semester($idsemester)
    {
        
        LivewireAlert::title('Delete Data')
        ->text('Are you sure you want to delete this data?')
        ->asConfirm()
        ->onConfirm('deleteItem', ['idsemester' => $idsemester])
        ->show();
        
        
        
    }

    public function deleteItem($array)
        {
            $idsemester = $array['idsemester'];
            $idinstansi = $this->idinstansi;

            semesterM::where(["idsemester" => $idsemester, "idinstansi" => $idinstansi])->delete();

            \Flux::toast(variant: 'success', heading: 'Success!', text:"Data berhasil dihapus!.");

        }
}
