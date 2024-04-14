<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Departments extends Model
{
    public function Employees(): HasMany
    {
        return $this->hasMany(Employees::class);
    }

    public function leaverequests()
    {
        return $this->hasMany(LeaveRequests::class);
    }
}
