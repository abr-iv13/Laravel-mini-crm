<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{

    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender_id',
        'position_id',
        'section_id',
        'status_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'date:d.m.y',
        'updated_at' => 'date:d.m.y',
    ];

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
}
