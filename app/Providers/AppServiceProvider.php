<?php

namespace App\Providers;

use App\Http\Resources\ClassroomCollection;
use App\Models\Classwork;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // ResourceCollection::withoutWrapping();

        // echo config('database.connections.mysql.driver');
        Relation::enforceMorphMap([
            'post'=>Post::class,
            'classwork'=>Classwork::class,
            'user'=>User::class,
        ]);

        Paginator::defaultView('vendor.pagination.bootstrap-5');
        Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-5');
        // Paginator::useBootstrapFive();
    }
}
