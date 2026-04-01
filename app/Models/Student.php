<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'city', 'inrollment_no'];
    
    // Fixed: renamed from courses() to course() — hasOne returns a single model, not a collection
    public function course(): HasOne
    {
        return $this->hasOne(Course::class);
    }
}