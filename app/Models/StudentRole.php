<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRole extends Model
{
    use HasFactory;

    protected $table = 'student_roles'; // テーブル名

    protected $primaryKey = 'role_id'; // 主キーを role_id に設定

    public $incrementing = true; // 自動インクリメント

    protected $keyType = 'int'; // 主キーの型

    protected $fillable = [
        'role_name',
        'permission_level'
    ]; // 追加可能なカラム

    protected $casts = [
        'permission_level' => 'integer',
    ];
}
