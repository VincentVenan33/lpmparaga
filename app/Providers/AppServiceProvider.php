<?php

namespace App\Providers;

use App\Models\ContactModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $username = auth()->check() ? auth()->user()->name : null;
            $view->with('username', $username);

            if (Auth::check()) {
                $data = array();
                $unread_count = ContactModel::where('status', 0)->count();
                $view->with('unread_count', $unread_count);
                $data['unread_count'] = $unread_count;
            }
        });
    }
}