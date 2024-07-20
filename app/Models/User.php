<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'expire_at',
        'code'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function generateCode(){
        $this->timestamps = false;
        $this->code = rand(1000,9999);
        $this->expire_at = now()->addMinute(15);
        $this->save();
    }

    public function resetCode(){
        $this->timestamps = false;
        $this->code = null;
        $this->expire_at = null;
        $this->save();
    }
}
