<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students'; // テーブル名

    protected $fillable = [
        'name',
        'email',
        'line_id',
        'level',
        'ticket_count',
        'ticket_expiry_date',
        'status',
        'role_id'
    ]; // 一括代入可能なカラム

    protected $casts = [
        'level' => 'integer',
        'ticket_count' => 'integer',
        'ticket_expiry_date' => 'date',
        'role_id' => 'integer',
        'status' => 'string',
    ];

    /**
     * 学生のロールを取得（リレーション）
     */
    public function role()
    {
        return $this->belongsTo(StudentRole::class, 'role_id', 'role_id');
    }
    public function login(): MorphOne
    {
        return $this->morphOne(Login::class, 'user');
    }
}
