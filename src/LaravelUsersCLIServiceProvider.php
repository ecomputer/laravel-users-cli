<?php
/**
 * Copyright (C) Ecomputer 2017
 * User: Dev_NIX
 * Date: 2/16/17
 * Time: 10:08 AM
 */

namespace Ecomputer\LaravelUsersCLI;

use Illuminate\Support\ServiceProvider;


class LaravelUsersCLIServiceProvider extends ServiceProvider
{
    protected $commands = [
        Commands\CreateUser::class,
        Commands\DeleteUser::class,
        Commands\ListUsers::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
