<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    protected $guarded = [];
    protected $connection = 'mysql';
    
    //protected $fillable = ['name1','name2'];
    
    public function detailuser()
    {
        return $this->hasOne(detailuserM::class, 'iduser', 'iduser');
    }
    public function posisi()
    {
        return $this->hasOne(posisiM::class, 'iduser', 'iduser');
    }
    public function absenpelajaran()
    {
        return $this->hasMany(absenpelajaranM::class, 'iduser', 'iduser');
    }
    public function gurumapel()
    {
        return $this->hasMany(gurumapelM::class, 'iduser', 'iduser');
    }
    public function fotoprofil()
    {
        return $this->hasOne(fotoprofilM::class, 'iduser', 'iduser');
    }
    


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
