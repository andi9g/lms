<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jpM extends Model
{
    protected $table = 'jp';
    protected $primaryKey = 'idjp';
    protected $guarded = [];
    protected $connection = 'mysql';
    
    //protected $fillable = ['name1','name2'];
    
    public function instansi()
    {
        return $this->belongsTo(instansiM::class, 'idinstansi', 'idinstansi');
    }
}
