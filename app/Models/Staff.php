<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'email',
        'last_name',
        'first_name',
        'user_number', // user_numberを追加
        'password', // passwordを追加
        'role_id', // role_idを追加
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

    public function role()
    {
        return $this->belongsTo(StaffRole::class, 'role_id');
    }
}
