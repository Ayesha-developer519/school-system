<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['exam_id', 'student_id', 'subject_id', 'marks_obtained', 'total_marks'])]
class Result extends Model
{
    use HasFactory;

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getPercentageAttribute()
    {
        return $this->total_marks > 0
            ? round(($this->marks_obtained / $this->total_marks) * 100, 1)
            : 0;
    }

    public function getGradeAttribute()
    {
        $percentage = $this->percentage;

        return match(true) {
            $percentage >= 90 => 'A+',
            $percentage >= 80 => 'A',
            $percentage >= 70 => 'B',
            $percentage >= 60 => 'C',
            $percentage >= 50 => 'D',
            default => 'F',
        };
    }
}
