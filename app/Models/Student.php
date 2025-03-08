<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'line_id',
        'level',
        'ticket_count',
        'ticket_expiry_date',
        'status',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    const STATUS = [
        0 => '退会',
        1 => '休会',
        2 => 'レギュラー',
        3 => '仮会員',
    ];

    public function getStatusLabel()
    {
        return self::STATUS[$this->status] ?? '不明';
    }

    // 生徒が参加しているレッスン
    public function lessons()
    {
        return $this->belongsToMany(LessonSchedule::class, 'lesson_students', 'student_id', 'lesson_schedule_id');
    }
}
