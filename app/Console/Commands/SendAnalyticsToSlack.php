<?php

namespace App\Console\Commands;

use App\Repositories\NotificationRepositoryInterface;
use Illuminate\Console\Command;

class SendAnalyticsToSlack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qeoqeo:send-analytic-to-slack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Analytics To Slack';

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
        app(NotificationRepositoryInterface::class)->sendAnalyticsToSlack();
    }
}
