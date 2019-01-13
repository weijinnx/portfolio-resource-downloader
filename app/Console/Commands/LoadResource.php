<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libraries\ResourceLoader;
use Validator;

class LoadResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aurox:load {url? : Resource URL}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'You can use this command to download resource from pasted URL';

    /**
     * Resource Loader class
     *
     * @var ResourceLoader
     */
    protected $rl;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ResourceLoader $rl)
    {
        parent::__construct();

        $this->rl = $rl;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url');

        if ($url === null) {
            $url = $this->ask('Please, provide a URL:');

            $validator = Validator::make(
                ['url' => $url],
                ['url' => 'required|url']
            );

            if ($validator->fails()) {
                $this->info('You have some validation errors:');

                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }

                return 1;
            }
        }

        $prepareJob = $this->rl->dispatchJob($url);

        if ($prepareJob === true) {
            $this->info('Job created. Resource will be downloaded soon.');
        }

        return 0;
    }
}
