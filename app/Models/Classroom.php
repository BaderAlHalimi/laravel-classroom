<?php

namespace App\Models;

use App\Models\Scopes\UserClassroomScope;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Classroom extends Model
{
    use HasFactory;
    public static $disk = 'uploads';
    protected $fillable = [
        'name', 'section', 'subject', 'room', 'code', 'cover_image_path'
    ];
    public function getRouteKeyName()
    {
        return 'id';
    } //to select the row you need on the parameter on url

    protected static function booted()
    {
        static::addGlobalScope(new UserClassroomScope);
        static::creating(function(Classroom $classroom){
            $classroom->code = str::random(10);
        });
    }

    public function classworks(): HasMany
    {
        return $this->hasMany(Classwork::class, 'classroom_id', 'id');
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'classroom_id', 'id');
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class, 'classroom_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'classroom_user',
            'classroom_id',
            'user_id',
            'id',
            'id'
        )->withPivot(['role', 'created_at']);
    }
    protected $appends = [
        // 'cover_image_url'
    ];
    protected $hidden = [
        'cover_image_path',
        'daleted_at',
    ];
    public function teachers()
    {
        return $this->users()->wherePivot('role', 'teacher');
    }
    public function students()
    {
        return $this->users()->wherePivot('role', 'student');
    }
    public function streams()
    {
        return $this->hasMany(Stream::class)->latest();
    }
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }
    public function join($user_id, $role)
    {
        $exists = $this
            ->users()
            ->wherePivot('user_id', $user_id)
            ->exists();
        if ($exists) {
            throw new Exception('user already joined the classroom');
        }

        $this->users()->attach([$user_id], [ //ممكن ارسال اكثر من مستخدم، فبيتم اضافة نفس المدخلات لهم، أو أدخل المدخلات كقيمة والمستخدم كمفتاح لهاي القيمة
            'role'          => $role,
            'created_at'    => now()
        ]);
        // DB::table('classroom_user')->insert([
        //     'classroom_id'  => $this->id,
        //     'user_id'       => 'user_id',
        //     'role'          => $role,
        //     'created_at'    => now()
        // ]);
    }
}
