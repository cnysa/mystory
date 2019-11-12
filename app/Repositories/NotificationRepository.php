<?php

namespace App\Repositories;

use Analytics;
use Spatie\Analytics\Period;
use QSlack;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function sendAnalyticsToSlack()
    {
        $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(1))[0];
        $text = 'Google Analytics date *' . $analyticsData['date']->format('Y-m-d') . '*';
        $text .= ' -- 👉 Visitors: *' . $analyticsData['visitors'] . '*';
        $text .= ' -- 👉 Page Views: *' . $analyticsData['pageViews'] . '* 👏';

        QSlack::send(['attachments' => [
            [
                'text' => $text,
                'color' => '#36a64f'
            ]
        ]]);
    }
}
