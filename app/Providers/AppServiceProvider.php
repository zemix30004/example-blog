<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('pages._sidebar', function ($view) {
            $view->with('popularPosts', Post::orderBy('views', 'desc')->take(3)->get());
            $view->with('featuredPosts', Post::where('is_featured', 1)->take(3)->get());
            $view->with('recentPosts', Post::orderBy('date', 'desc')->take(3)->get());
            $view->with('categories', Category::all());
        });
        view()->composer('admin._sidebar', function ($view) {
            $view->with('newCommentsCount', Comment::where('status', 1)->count());
        });
    }
}
