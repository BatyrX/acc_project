<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $fillable = [
        'campus_name',
        'korpus',
        'classroom',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function ipAddresses()
    {
        return $this->hasMany(IpAddress::class);
    }
}
