<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timesheet extends Model
{
    public function employees()
    {
        return $this->belongsTo(Employees::class);
    }

    public function schedules()
    {
        return $this->belongsTo(Schedule::class);
    }
}
