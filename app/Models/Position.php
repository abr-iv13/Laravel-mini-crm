<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';
    
    protected $fillable = [
        'title',
        'updated_at',
        'created_at',
    ];
    protected $casts = [
        'created_at' => 'date:d.m.y',
        'updated_at' => 'date:d.m.y',
    ];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
