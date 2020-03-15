<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $fillable = ['type', 'path'];

    const TYPE_AVATAR = 1;
    const TYPE_CONTENT = 2;

    public static $type = [
        self::TYPE_AVATAR  => 'avatar',
        self::TYPE_CONTENT => 'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
