<?php

namespace App\Providers;

use App\Repositories\BookingRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\RoomRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
