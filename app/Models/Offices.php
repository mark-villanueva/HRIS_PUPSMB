<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offices extends Model
{
    public function Employees(): HasMany
    {
        return $this->hasMany(Employees::class);
    }
}
