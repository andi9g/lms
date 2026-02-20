<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class absenpelajaranM extends Model
{
    protected $table = 'absenpelajaran';
    protected $primaryKey = 'idabsenpelajaran';
    protected $guarded = [];
    protected $connection = 'mysql';
    
    //protected $fillable = ['name1','name2'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
    public function gurumapel()
    {
        return $this->belongsTo(gurumapelM::class, 'idgurumapel', 'idgurumapel');
    }
    public function jp()
    {
        return $this->belongsTo(jpM::class, 'idjp', 'idjp');
    }
    public function ruang()
    {
        return $this->belongsTo(ruangM::class, 'idruang', 'idruang');
    }
}
