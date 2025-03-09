<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentTicket; // 追加

class TicketTransaction extends Model
{
    use HasFactory;

    protected $table = 'ticket_transactions';

    protected $fillable = [
        'student_ticket_id',
        'lesson_student_record_id',
        'transaction_type',
        'ticket_change',
    ];

    public function studentTicket()
    {
        return $this->belongsTo(StudentTicket::class);
    }

    public function lessonStudentRecord()
    {
        return $this->belongsTo(LessonStudentRecord::class);
    }
}
