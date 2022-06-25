<?php
namespace App\Providers;
 
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
 
class ComposerServiceProvider extends ServiceProvider
{
    // composer viewを導入する
    public function boot()
    {
        View::composer('*', 'App\Http\ViewComposers\HogeComposer');
    }
}