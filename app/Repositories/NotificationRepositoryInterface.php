<?php

namespace App\Repositories;

interface NotificationRepositoryInterface
{
    public function sendAnalyticsToSlack();
}
