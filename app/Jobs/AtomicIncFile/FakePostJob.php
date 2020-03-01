<?php

namespace App\Jobs\AtomicIncFile;

use App\Contracts\Request\MakeRequest;
use App\Services\AtomicIncFile\FakePostRequestService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
use App\Exceptions\RequestException;

class FakePostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $retryAfter = 30;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 30;

    /**
     * Execute the job.
     *
     * @throws RequestException
     * @return void
     */
    public function handle()
    {
        /** @var MakeRequest $fakePostRequestService */
        $fakePostRequestService = app(FakePostRequestService::class);

        $fakePostRequestService->send();
    }

    /**
     * The job failed to process.
     *
     * @param RequestException|Exception $requestException
     * @return void
     */
    public function failed(RequestException $requestException)
    {
        logger('hola');
        // Send user notification of failure, etc...
    }
}
