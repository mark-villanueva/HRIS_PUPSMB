<?php

namespace App\Models;

use EightyNine\Approvals\Models\ApprovableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequests extends ApprovableModel
{
    use HasFactory;
 
    protected $fillable = ["name"];

    public function employees()
    {
        return $this->belongsTo(Employees::class);
    }

    public function leavetypes()
    {
        return $this->belongsTo(LeaveTypes::class);
    }

    public function departments()
    {
        return $this->belongsTo(Departments::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}










