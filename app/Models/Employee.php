<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $table = 'employee';
    protected $fillable = ['email'];

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }
}
