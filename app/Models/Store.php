<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model};

/**
 * Class Store
 *
 * @package App\Models
 *
 * @mixin Builder
 */
class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform'
    ];

    public $timestamps = false;
}
