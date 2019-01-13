<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Libraries\ResourceLoader;
use App\Models\Resource;

class DownloadResource implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Resource URL
     *
     * @var string
     */
    protected $resource;

    /**
     * Create a new job instance.
     *
     * @param Resource $resource Resource DB model
     * 
     * @return void
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $resource = $this->resource;

        try {
            $resource->status = 1;
            $resource->filename = ResourceLoader::download($resource->url);
        } catch (\Exception $e) {
            $resource->status = 3;
        }

        $resource->save();
    }

}
