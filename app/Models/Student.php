<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'university',
        'major',
        'bio',
    ];

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }

    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }
}
