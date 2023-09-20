<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    const CREATER_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    // protected $connection = "mysql";
    // protected $table = 'topics';
    // protected $primeryKey = 'id';
    // protected $keyType = 'int';
    // public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'user_id',
        'classroom_id',
    ];

    public function classworks(){
        return $this->hasMany(Classwork::class,'topic_id','id');
    }
}
