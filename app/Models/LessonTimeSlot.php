<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LessonTimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'weekday_type',
        'start_time',
        'end_time',
    ];

    public function lessonSchedules()
    {
        return $this->hasMany(LessonSchedule::class);
    }

    public static function getTimeSlotsByWeekdayType($weekdayType)
    {
        return self::where('weekday_type', $weekdayType)->get()->map(function ($timeSlot) {
            return $timeSlot->class_name . ' ' . Carbon::parse($timeSlot->start_time)->format('H:i') . '〜' . Carbon::parse($timeSlot->end_time)->format('H:i');
        })->toArray();
    }

    public static function compareWeekendAndSaturdayJrTimes()
    {
        $weekendDayData = self::where('weekday_type', 'WEEKENDDAY')->get();
        $saturdayJrData = self::where('weekday_type', 'SATURDAY-JR')->get();
        $result = [];

        foreach ($weekendDayData as $weekend) {
            $weekendStart = Carbon::parse($weekend->start_time);
            $weekendEnd = Carbon::parse($weekend->end_time);
            $saturdayClasses = [];

            foreach ($saturdayJrData as $saturday) {
                $saturdayStart = Carbon::parse($saturday->start_time);
                $saturdayEnd = Carbon::parse($saturday->end_time);

                if ($weekendStart < $saturdayEnd && $saturdayStart < $weekendEnd) {
                    $saturdayClasses[] = ["class" => "ジュニア"];
                    break; // 他のクラスがあれば追加しない
                }
            }

            $result[$weekend->class_name . ' ' . $weekendStart->format('H:i') . '〜' . $weekendEnd->format('H:i')] = [
                '1' => [ // コート番号
                    '1' => $saturdayClasses // 土曜日のクラス
                ]
            ];
        }

        return $result;
    }
    // `start_time` を `HH:MM` 形式で取得
    public function getStartTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    // `end_time` を `HH:MM` 形式で取得
    public function getEndTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    // `start_time` を `HH:MM` 形式で保存
    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }

    // `end_time` を `HH:MM` 形式で保存
    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }
}
