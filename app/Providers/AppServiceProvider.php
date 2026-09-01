<?php
namespace App\Providers;
use App\Models\About;
use App\Models\Category;
use App\Models\Companyprofile;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        view()->share('content', Companyprofile::first());
        view()->share('about', About::first());
        view()->share('services', Service::where('status', 1)->orderBy('order')->get());
        // view()->share('categories', Category::withCount('products')->orderBy('name')->get());
        // view()->share('shopProducts', Product::with('category')->latest()->take(8)->get());
    }
}
