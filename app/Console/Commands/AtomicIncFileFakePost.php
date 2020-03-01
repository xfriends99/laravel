<?php

namespace App\Console\Commands;

use App\Jobs\AtomicIncFile\FakePostJob;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class AtomicIncFileFakePost extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atomic-incfile:fake-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send requests to fake post endpoint';

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
        /** @var  $job */
        $job = (new FakePostJob())->onQueue('atomic-incfile');
        $dispatch = $this->dispatch($job);

        $this->info("The job {$dispatch->id} is being processed");
    }
}
