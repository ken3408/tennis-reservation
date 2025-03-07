<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Login extends Model
{
    use HasFactory;

    protected $table = 'logins';

    protected $fillable = [
        'provider',
        'identifier',
        'password',
        'user_id',
        'user_type'
    ];

    protected $hidden = ['password']; // パスワードを隠す

    /**
     * 学生またはスタッフに紐づくリレーション（ポリモーフィック）
     */
    public function user(): MorphTo
    {
        return $this->morphTo();
    }
}
