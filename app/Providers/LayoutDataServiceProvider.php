<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Categorie;

class LayoutDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     * I used a "trick" to get categories data inside all functionnal view by putting the data in the layout in boot
     * This can cause issue to migration as categories table migth not be created
     * To fix this just switch the comment/uncomment section bellow temporarly and run the migration after
     * @return void
     */
    public function boot()
    {
    
        view()->composer('*', function($view) {
            $categories = Categorie::all();
            $view->with(['categories' => $categories]);
        });

        
        // view()->composer('layouts.app', function($view) {
        //     $view;
        // });
    }
}
