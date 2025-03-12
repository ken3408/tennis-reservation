<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lesson_master_id' => 'required',
            'staff_id' => 'nullable',
            'lesson_time_slot_name' => 'required',
            'lesson_time_slot_weekday_type' => 'required',
            'year_month' => 'required|date_format:Ym',
            'weekday' => 'required|string',
            'court_num' => 'required|integer',
        ];
    }
}
