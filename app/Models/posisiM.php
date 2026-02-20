<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class posisiM extends Model
{
    protected $table = 'posisi';
    protected $primaryKey = 'idposisi';
    protected $guarded = [];
    protected $connection = 'mysql';
    
    //protected $fillable = ['name1','name2'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
