<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_TECHNICIAN = 0;
    const ROLE_ADMIN = 1;
    const ROLE_ENGINEER = 2;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'role',
        'password',
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

    public function ipAddresses()
    {
        return $this->hasMany(IpAddress::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public static function getRoleText(int $role): string
    {
        return match ($role) {
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_ENGINEER => 'Инженер',
            self::ROLE_TECHNICIAN => 'Техник',
        };
    }
    
    public static function getRoles(): array
    {
        return [
            self::ROLE_TECHNICIAN => 'Техник',
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_ENGINEER => 'Инженер',
        ];
    }
}
