<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    protected $table = 'goal';
    protected $fillable = ['name', 'progress'];

    public function emploee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
