<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $fillable = ['name', 'key', 'is_active', 'last_used_at'];

    protected $casts = [
        'is_active' => 'boolean',
        'last_used_at' => 'datetime',
    ];

    public static function findActive(string $key): ?self
    {
        return static::where('key', $key)
            ->where('is_active', true)
            ->first();
    }
}
