<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gurumapelM extends Model
{
    protected $table = 'gurumapel';
    protected $primaryKey = 'idgurumapel';
    protected $guarded = [];
    protected $connection = 'mysql';
    
    //protected $fillable = ['name1','name2'];
    
    public function absenpelajaran()
    {
        return $this->hasMany(absenpelajaranM::class, 'idgurumapel', 'idgurumapel');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
    public function kelas()
    {
        return $this->belongsTo(kelasM::class, 'idkelas', 'idkelas');
    }
    public function mapel()
    {
        return $this->belongsTo(mapelM::class, 'idmapel', 'idmapel');
    }
    public function semester()
    {
        return $this->belongsTo(semesterM::class, 'idsemester', 'idsemester');
    }
    public function jurusan()
    {
        return $this->belongsTo(jurusanM::class, 'idjurusan', 'idjurusan');
    }
}
