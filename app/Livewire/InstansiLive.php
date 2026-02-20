<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\instansiM;

class InstansiLive extends Component
{
    use WithFileUploads;
    #[Validate('image|max:10240')] // 10MB Max
    
    public $photo;

    public function render()
    {
        $instansi = instansiM::get();
        return view('livewire.instansi-live', [
            "instansi" => $instansi,
        ]);
    }

    public function removePhoto()
    {
        $this->photo->delete();
        $this->photo = null;
    }
    public function save()
    {
        $path = $this->photo->store("photos", "public");

        
    }
}
