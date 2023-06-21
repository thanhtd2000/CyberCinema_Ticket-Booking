<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::tokensExpireIn(Carbon::now()->addMinutes(60));

        Gate::define('list-room', function (User $user) {
            $role =   Role::where('key', 'list-room')->where('check', 1)->first();
            return $user->role == 0 || $role == null ? '' : 3;
        });
        // Actor
        Gate::define('list-actor', 'App\Policies\ActorPolicy@view');
        Gate::define('create-actor', 'App\Policies\ActorPolicy@create');
        Gate::define('edit-actor', 'App\Policies\ActorPolicy@update');
        Gate::define('delete-actor', 'App\Policies\ActorPolicy@delete');

        //Category
        Gate::define('list-category', 'App\Policies\CategoryPolicy@view');
        Gate::define('create-category', 'App\Policies\CategoryPolicy@create');
        Gate::define('edit-category', 'App\Policies\CategoryPolicy@update');
        Gate::define('delete-category', 'App\Policies\CategoryPolicy@delete');

        //Director
        Gate::define('list-director', 'App\Policies\DirectorPolicy@view');
        Gate::define('create-director', 'App\Policies\DirectorPolicy@create');
        Gate::define('edit-director', 'App\Policies\DirectorPolicy@update');
        Gate::define('delete-director', 'App\Policies\DirectorPolicy@delete');

        //Movie
        Gate::define('list-movie', 'App\Policies\MoviePolicy@view');
        Gate::define('create-movie', 'App\Policies\MoviePolicy@create');
        Gate::define('edit-movie', 'App\Policies\MoviePolicy@update');
        Gate::define('delete-movie', 'App\Policies\MoviePolicy@delete');

        //Post
        Gate::define('list-post', 'App\Policies\PostPolicy@view');
        Gate::define('create-post', 'App\Policies\PostPolicy@create');
        Gate::define('edit-post', 'App\Policies\PostPolicy@update');
        Gate::define('delete-post', 'App\Policies\PostPolicy@delete');

        //Product
        Gate::define('list-product', 'App\Policies\ProductPolicy@view');
        Gate::define('create-product', 'App\Policies\ProductPolicy@create');
        Gate::define('edit-product', 'App\Policies\ProductPolicy@update');
        Gate::define('delete-product', 'App\Policies\ProductPolicy@delete');

        //Room
        Gate::define('list-room', 'App\Policies\RoomPolicy@view');
        Gate::define('create-room', 'App\Policies\RoomPolicy@create');
        Gate::define('edit-room', 'App\Policies\RoomPolicy@update');
        Gate::define('delete-room', 'App\Policies\RoomPolicy@delete');

        //Schedule
        Gate::define('list-schedule', 'App\Policies\SchedulePolicy@view');
        Gate::define('create-schedule', 'App\Policies\SchedulePolicy@create');
        Gate::define('edit-schedule', 'App\Policies\SchedulePolicy@update');
        Gate::define('delete-schedule', 'App\Policies\SchedulePolicy@delete');

        //Seat
        Gate::define('list-seat', 'App\Policies\SeatPolicy@view');
        Gate::define('create-seat', 'App\Policies\SeatPolicy@create');
        Gate::define('edit-seat', 'App\Policies\SeatPolicy@update');
        Gate::define('delete-seat', 'App\Policies\SeatPolicy@delete');

        //SeatType
        Gate::define('list-seatType', 'App\Policies\SeatTypePolicy@view');
        Gate::define('create-seatType', 'App\Policies\SeatTypePolicy@create');
        Gate::define('edit-seatType', 'App\Policies\SeatTypePolicy@update');
        Gate::define('delete-seatType', 'App\Policies\SeatTypePolicy@delete');

        //User
        Gate::define('list-user', 'App\Policies\UserPolicy@view');
        Gate::define('create-user', 'App\Policies\UserPolicy@create');
        Gate::define('edit-user', 'App\Policies\UserPolicy@update');
        Gate::define('delete-user', 'App\Policies\UserPolicy@delete');
    }
}
