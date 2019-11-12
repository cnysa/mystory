<?php

namespace Url\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Url\Controllers\AppController;

class UrlTrackingRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $urlId;
    protected $ip;
    protected $userAgent;

    /**
     * Create a new job instance.
     *
     * @param $urlId
     * @param $ip
     * @param $userAgent
     */
    public function __construct($urlId, $ip, $userAgent)
    {
        $this->urlId = $urlId;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->delete();

        app(AppController::class)->trackingRecord($this->urlId, $this->ip, $this->userAgent);
    }
}
