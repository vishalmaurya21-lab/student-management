<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $fillable = ['student_id', 'course_name'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}