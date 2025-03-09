<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketTransaction;

class TicketTransactionSeeder extends Seeder
{
    public function run()
    {
        TicketTransaction::create([
            'student_ticket_id' => 1,
            'lesson_student_record_id' => 1,
            'transaction_type' => 'purchase',
            'ticket_change' => 10,
        ]);

        TicketTransaction::create([
            'student_ticket_id' => 1,
            'lesson_student_record_id' => 2,
            'transaction_type' => 'use',
            'ticket_change' => -1,
        ]);
    }
}
