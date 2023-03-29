<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use UuidTrait;
    protected $fillable = [
        'name',
        'currency_code',
        'exchange_rate',
    ];

    public $timestamps = NULL;
}
