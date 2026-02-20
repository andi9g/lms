<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mapelM extends Model
{
    protected $table = 'mapel';
    protected $primaryKey = 'idmapel';
    protected $guarded = [];
    protected $connection = 'mysql';
    
    //protected $fillable = ['name1','name2'];
    
    public function instansi()
    {
        return $this->belongsTo(instansiM::class, 'idinstansi', 'idinstansi');
    }
    public function gurumapel()
    {
        return $this->belongsTo(gurumapelM::class, 'idmapel', 'idmapel');
    }
}
