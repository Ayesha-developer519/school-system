<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['exam_name', 'class_id', 'exam_date'])]
class Exam extends Model
{
    use HasFactory;

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
