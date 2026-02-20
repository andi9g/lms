<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fotoprofilM extends Model
{
    protected $table = 'fotoprofil';
    protected $primaryKey = 'idfotoprofil';
    protected $guarded = [];
    protected $connection = 'mysql';
    
    //protected $fillable = ['name1','name2'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
