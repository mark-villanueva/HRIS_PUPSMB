<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    public function employees()
    {
        return $this->belongsTo(Employees::class);
    }

    public function getFullNameAttribute()
    {
        // Assuming ModelA is the name of the first model and you want to access it through a relationship
        return $this->employees->fullname; // Assuming 'modelA' is the relationship name
    }
}
