<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'department', 'employee_id', 'qualifications', 'status'];

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
