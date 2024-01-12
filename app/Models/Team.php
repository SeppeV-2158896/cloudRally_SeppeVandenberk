<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pilot',
        'copilot',
        'car',
        'constructor',
    ];

    public function pilot(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'pilot');
    }

    public function copilot(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'copilot');
    }
    

}
