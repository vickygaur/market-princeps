<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'help_category',
        'name',
        'email',
        'phone',
        'company',
        'message',
        'status',
        'source',
        'meta',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'read_at' => 'datetime',
        ];
    }
}
