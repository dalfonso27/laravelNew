<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'title',
    ];
    /**
    * Profession relation with User Table
    *
    * @return Eloquent Collection of User Class
    */
    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
