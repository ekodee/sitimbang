<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truk extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'truk_id';

    protected $guarded = [
        'truk_id'
    ];

    public function supirs() : HasMany
    {
        return $this->hasMany(Supir::class, 'truk_id', 'truk_id');
    }

    public function timbangans(): HasMany
    {
        return $this->hasMany(Timbangan::class, 'truk_id', 'truk_id');
    }
}
