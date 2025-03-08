<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonMaster extends Model
{
    use HasFactory;

    protected $table = 'lesson_master';

    protected $fillable = [
        'name',
        'level',
        'category',
    ];

    // レッスンマスターが持つスケジュール
    public function schedules()
    {
        return $this->hasMany(LessonSchedule::class, 'lesson_master_id');
    }
}
