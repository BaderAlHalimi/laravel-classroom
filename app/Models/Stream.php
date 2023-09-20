<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stream extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'classroom_id',
        'user_id',
        'content',
        'link',
    ];
    protected static function booted()
    {
        //تم ايقافها لانا استخدمنا ال HasUuids الي بتعمل العملية بشكل تلقائي
        // static::creating(function(Stream $stream){
        //     $stream->id = Str::uuid();
        // });
    }

    public function uniqueIds()
    {
        return [
            'id'
        ];
    }

    public function getUpdatedAtColumn()
    {
    }
    public function setUpdatedAt($value)
    {
        return $this;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
