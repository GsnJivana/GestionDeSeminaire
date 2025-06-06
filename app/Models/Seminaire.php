<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Seminaire extends Model
{
    //
    protected $guarded = [];
    protected $casts = [
    'date_de_presentation' => 'datetime',
];
    public function presentateur(): BelongsTo {
        return $this->belongsTo(User::class,'presentateur_id');
    }

    public function copresentateur(): BelongsToMany {
        return $this->belongsToMany(User::class, 'presentateurs', 'seminaire_id', 'presentateur_id');
    }
}
