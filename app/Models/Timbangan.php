<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timbangan extends Model
{
    use HasFactory;
    protected $primaryKey = 'timbangan_id';

    protected $guarded = ['timbangan_id'];

    protected $casts = [
        'waktu_masuk' => 'datetime',
    ];

    public function supirs(): BelongsTo
    {
        return $this->belongsTo(Supir::class, 'supir_id', 'supir_id');
    }

    public function truks(): BelongsTo
    {
        return $this->belongsTo(Truk::class, 'truk_id', 'truk_id');
    }
}
