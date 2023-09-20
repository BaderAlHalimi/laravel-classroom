<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'content',
        'ip',
        'user_agent'
    ];
    protected $with = [
        'user'
    ];
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'Removed user',
        ]);
    }

    public function commentable()
    {
        return $this->morphTo(); //إذا اسم الميثود مختلف عن الكولومن ، بندخل اسم الكولومن بالدالة مورف
    }
}
