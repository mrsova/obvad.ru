<?php

namespace App\Providers;

use App\Meta;
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
        //появляется до рендеринга вызываем  метод и вьюху в коротру данные передаем в колбеке запросы и переменные которые передаем
        view()->composer('front.layout', function($view){
            $view->with('title', Meta::find(2)->title);
            $view->with('description', Meta::find(2)->description);
            $view->with('keywords', Meta::find(2)->keywords);
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
