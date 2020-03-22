<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class Topic extends Model
{
    protected $fillable = ['category_id', 'user_id', 'title', 'body'];

    # 模型关联 start
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    # 模型关联 end
}
