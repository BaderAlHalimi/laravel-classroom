<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassworkUser extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'classroom_id',
        'user_id',
        'role',
        'created_at'
    ];
    public function setUpdatedAt($value)
    {
        return $this;
    }
    public function getUpdatedAtColumn()
    {
    }
}
