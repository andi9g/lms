<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\mapelM;
use App\Models\semesterM;
use App\Models\ruangM;
use App\Models\jpM;
use App\Models\gurumapelM;
use App\Models\absenpelajaranM;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Session;
use Auth;
use Locked;

class AbsenLive extends Component
{
    #[Locked]
    public $iduser;

    public $idgurumapel, $masuk,$keluar, $idruang, $materi, $tanggalabsen, $jamabsen;

    public function mount()
    {
        $this->iduser = auth()->user()->iduser; 
    }
    public function render()
    {
        $dataabsenpelajaran = absenpelajaranM::where(["iduser" => $this->iduser, "tanggalabsen" => date("Y-m-d")])->orderBy("masuk", "asc")->get();
        
        $gurumapel = gurumapelM::where(["iduser"=> $this->iduser, "idsemester" => Session::get("idsemester")])
        ->get();
        $ruang = ruangM::get();

        $data = $dataabsenpelajaran->select("masuk", "keluar")->toArray();

        $jp = jpM::orderBy("namajp", "asc")->pluck("namajp")->toArray();
        $terpakai = [];
        
        foreach ($data as $item) {
            $terpakai = array_merge($terpakai, range($item['masuk'], $item['keluar']));
        }
        $terpakai = array_unique($terpakai);
        $sisa = array_values(array_diff($jp, $terpakai));
        sort($sisa);
        

        // $absenpelajaran = $dataabsenpelajaran->get();
        return view('livewire.absen-live', [
            "gurumapel" => $gurumapel,
            "ruang" => $ruang,
            "jp" => $jp,
            "sisa" => $sisa,
            "absenpelajaran" => $dataabsenpelajaran,
        ]);
    }

    public function absen()
    {
        $this->validate([
            "idgurumapel" => "required",
            "masuk" => "required|numeric",
            "keluar" => "required|numeric|gte:masuk",
            "idruang" => "required",
            "materi" => "required",
        ], [
            "required" => "Wajib di isi.",
            "numeric" => "Error!.",
            "keluar.gt" => "Jam keluar tidak valid"
        ]);

        

        $tanggalabsen = date("Y-m-d");
        $jamabsen = date("H:i:s");

        $tglindo = Carbon::parse($tanggalabsen." ".$jamabsen)->locale("id")->isoFormat("dddd, DD MMMM YYYY, H:m:s");

        absenpelajaranM::create([
            "iduser" => $this->iduser,
            "idgurumapel" => $this->idgurumapel,
            "masuk" => $this->masuk,
            "keluar" => $this->keluar,
            "idruang" => $this->idruang,
            "materi" => $this->materi,
            "tanggalabsen" => $tanggalabsen,
            "jamabsen" => $jamabsen,
        ]);

        $this->reset(["idgurumapel", "masuk", "keluar", "idruang", "materi"]);
        
        LivewireAlert::title('Success')->text("Berhasil absen pada ".$tglindo)->success()->show();
    }
}
