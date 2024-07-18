<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Notification\Repositories\NotificationRepository;
use Illuminate\Support\Facades\Auth;


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
        // Using view composer to set following variables globally
        view()->composer('*',function($view) {

            $user = Auth::user();

            if($user){
                $filter['requests.created_by'] = $user->user_id;
                $filter['notifications.notification_is_read'] = false;

                $notificationRepository = new NotificationRepository();

                $notifications = $notificationRepository->getAllByParamsPage($filter);
                $notif_count   = $notifications->count();
                $notif_unread  = false;

                if($notif_count > 0){
                    $notif_unread = true;
                }

                // dd($notif_unread);

                view()->share('notif_unread', $notif_unread);
            }
        });


        // Force https
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
