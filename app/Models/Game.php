<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $table = 'games';

    protected $guarded  = ['id', 'created_at', 'updated_at'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'levels',
        'release',
        'image',
    ];

    // protected $casts = [
    //     'release' => 'datetime:d/m/Y',
    // ];

    // public function getReleaseAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d/m/Y');
    // }
}
