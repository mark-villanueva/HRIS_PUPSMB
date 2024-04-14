<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
 

class Employees extends Model
{
    public function offices(): BelongsTo
    {
        return $this->belongsTo(Offices::class);
    }

    public function departments(): BelongsTo
    {
        return $this->belongsTo(Departments::class);
    }

    public function employmenttypes(): BelongsTo
    { 
        return $this->belongsTo(EmploymentTypes::class);
    }

    public function leaverequests()
    {
        return $this->hasMany(LeaveRequests::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}

