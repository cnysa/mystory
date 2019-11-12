<?php

namespace QSlack\Services;

use App\Helpers\QeoGuzzle;

class QSlack
{
    protected $config;
    protected $qGuzzle;

    public function __construct()
    {
        $this->config = config('qslack');
        $this->qGuzzle = app(QeoGuzzle::class);
    }

    public function send($dataSend)
    {
        $this->qGuzzle->send('POST', $this->config['webhook'], ['body' => json_encode($dataSend)]);
    }
}
