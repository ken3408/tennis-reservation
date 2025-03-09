<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTicket extends Model
{
    use HasFactory;

    protected $table = 'student_tickets';

    protected $fillable = [
        'student_id',
        'ticket_type_id',
        'remaining_tickets',
        'expiry_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
}
