<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Supir extends Model
{
    use HasFactory;
    protected $primaryKey = 'supir_id';

    protected $guarded = [
        'supir_id'
    ];

    // protected $fillable = [
    //     'nama',
    //     'no_hp',
    //     'no_ktp',
    // ]

    public function truks(): BelongsTo
    {
        return $this->belongsTo(Truk::class, 'truk_id', 'truk_id');
    }

    public function timbangans(): HasMany
    {
        return $this->hasMany(Timbangan::class, 'supir_id', 'supir_id');
    }
}
