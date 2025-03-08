<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTransaction extends Model
{
    use HasFactory;

    protected $table = 'ticket_transactions';

    protected $fillable = [
        'student_id',
        'lesson_id',
        'transaction_type',
        'ticket_count',
        'created_at',
    ];

    // 生徒との関係
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // レッスンとの関係
    public function lesson()
    {
        return $this->belongsTo(LessonMaster::class, 'lesson_id');
    }
}
