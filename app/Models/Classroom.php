<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    public static $disk = 'uploads';
    protected $fillable = [
        'name','section','subject','room','code','cover_image_path'
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }//to select the row you need on the parameter on url
}
