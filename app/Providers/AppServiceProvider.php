<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Queue;
use Log;
use App\Models\Resource;
use Illuminate\Queue\Events\JobProcessing;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::before(function (JobProcessing $event) {
            try {
                $payload = $event->job->payload();
                $command = unserialize($payload['data']['command']);
                $resource = $command->resource;
                $resource->status = 2;
                $resource->save();
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
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
