<?php

namespace App\Providers;

use App\Post;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //появляется до рендеринга вызываем  метод и вьюху в коротру данные передаем в колбеке запросы и переменные которые передаем
        view()->composer('admin._sidebar', function($view){
            $view->with('newPostCount', Post::where('status',0)->count());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
