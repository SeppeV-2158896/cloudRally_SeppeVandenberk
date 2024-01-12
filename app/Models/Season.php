<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'champion',
        'constructor_champion',
    ];

    public function rallies(): HasMany
    {
        return $this->hasMany(Rally::class, 'season_id');
    }

    public function champion(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'champion');
    }

    
}
