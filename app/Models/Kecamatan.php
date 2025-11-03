<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    protected $primaryKey = 'kecamatan_id';
    protected $guarded = ['kecamatan_id'];

    public function supirs(): HasMany
    {
        return $this->hasMany(Supir::class, 'kecamatan_id', 'kecamatan_id');
    }
}
