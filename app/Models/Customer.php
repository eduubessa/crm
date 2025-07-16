<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'assigned', 'file_id', 'reference', 'name', 'job', 'gender', 'tin', 'email', 'mobile_phone', 'phone_number',  'alternative_phone', 'address', 'city', 'state', 'country', 'postcode', 'country', 'birthday', 'notes',
    ];
}
