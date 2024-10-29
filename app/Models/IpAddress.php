<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_RESERVED = 2;
    protected $fillable = [
        'ip_address',
        'subnet',
        'mac_address',
        'status',
        'user_id',
        'campus_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public static function getStatus(int $status): string
    {
        return match ($status) {
            self::STATUS_INACTIVE => 'Не активен',
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_RESERVED => 'Зарезервирован',
        };
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_INACTIVE => 'Не активен',
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_RESERVED => 'Зарезервирован',
        ];
    }
}
