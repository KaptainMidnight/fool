<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'players',
        'deck',
        'table',
        'hands',
        'status',
        'trump_card',
        'current_player_index'
    ];

    protected function casts(): array
    {
        return [
            'players' => 'array',
            'deck' => 'array',
            'table' => 'array',
            'hands' => 'array',
        ];
    }
}
