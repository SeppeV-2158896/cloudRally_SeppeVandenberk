<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rally extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'start_date',
        'end_date',
        'winner',
        'second_place',
        'third_place',
        'interval_second',
        'interval_third',
        'season_id'
    ];

    

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'winner');
    }

    public function second_place(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'second_place');
    }

    public function third_place(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'third_place');
    }

    
}
