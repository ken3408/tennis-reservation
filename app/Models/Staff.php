<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    // メインコーチとして担当するレッスン
    public function mainLessons()
    {
        return $this->hasMany(LessonSchedule::class, 'staff_id');
    }

    // サブコーチとして担当するレッスン
    public function subLessons()
    {
        return $this->hasMany(LessonSchedule::class, 'sub_staff_id');
    }
}
