<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class instansiM extends Model
{
    protected $table = 'instansi';
    protected $primaryKey = 'idinstansi';
    protected $guarded = [];
    protected $connection = 'mysql';
    
    //protected $fillable = ['name1','name2'];
    
    public function detailuser()
    {
        return $this->hasMany(detailuserM::class, 'idinstansi', 'idinstansi');
    }
    public function kelas()
    {
        return $this->hasMany(kelasM::class, 'idinstansi', 'idinstansi');
    }
    public function jurusan()
    {
        return $this->hasMany(jurusanM::class, 'idinstansi', 'idinstansi');
    }
    public function mapel()
    {
        return $this->hasMany(mapelM::class, 'idinstansi', 'idinstansi');
    }
    public function jp()
    {
        return $this->hasMany(jpM::class, 'idinstansi', 'idinstansi');
    }
    public function semester()
    {
        return $this->hasMany(semesterM::class, 'idinstansi', 'idinstansi');
    }
    public function ruang()
    {
        return $this->hasMany(ruangM::class, 'idinstansi', 'idinstansi');
    }
}
