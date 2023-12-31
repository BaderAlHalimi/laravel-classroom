<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserClassroomScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if ($id = Auth::id()) {
            $builder->where('classrooms.user_id', 'id')
                ->orWhereExists(function (QueryBuilder $query) use ($id) {
                    $query->select(DB::raw('1'))
                        ->from('classroom_user')
                        ->whereColumn('classroom_user.classroom_id', '=', 'classrooms.id')
                        ->where('classroom_user.user_id', $id);
                });
        }
    }
}
