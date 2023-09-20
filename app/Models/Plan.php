<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function price(): Attribute
    {
        return new Attribute(
            get: fn ($price) => $price / 100,
            set: fn ($price) => $price * 100
        );
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'subscriptions');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'plan_feature')
            ->withPivot(['feature_value']);
    }
}
