<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurusanM extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'idjurusan';
    protected $guarded = [];
    protected $connection = 'mysql';
    
    //protected $fillable = ['name1','name2'];
    
    public function instansi()
    {
        return $this->belongsTo(instansiM::class, 'idinstansi', 'idinstansi');
    }

    public function gurumapel()
    {
        return $this->hasMany(gurumapelM::class, 'idkelas', 'idkelas');
    }
}
