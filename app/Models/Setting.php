<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'key', 'value', 'default'
    ];

    protected $casts = [
        'key' => 'string',
        'value' => 'string',
        'default' => 'string',
    ];

    protected $hidden = [
        'id'
    ];
}
