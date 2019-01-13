<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Resource;

class ResourcesList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aurox:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List of resources';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $resources = Resource::all(['id', 'url', 'filename', 'status'])->toArray();
        $this->line('Resources list');

        $headers = [
            'ID', 'URL', 'Filename', 'Status', 'Download'
        ];

        $this->table($headers, $resources);
    }
}
