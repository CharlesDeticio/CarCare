<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
        // Load admin notifications in all views starting with "admin."
        View::composer('admin.*', function ($view) {
            if (Auth::guard('admin')->check()) {
                $notifications = Notification::where('admin_id', Auth::guard('admin')->id())
                    ->latest()
                    ->take(10)
                    ->get();

                $unreadCount = Notification::where('admin_id', Auth::guard('admin')->id())
                    ->where('is_read', false)
                    ->count();

                $view->with([
                    'adminNotifications' => $notifications,
                    'adminUnreadCount' => $unreadCount
                ]);
            }
        });
    }
}
