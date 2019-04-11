<?php

namespace App\Listeners\Subscription;

use App\Events\Subscription\Subscribed;
use App\Services\Unisender\Contracts\Unisender;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSubscriberToMailingService implements ShouldQueue
{
    /**
     * @var Unisender
     */
    public $unisender;

    /**
     * @param Unisender $unisender
     */
    public function __construct(Unisender $unisender)
    {
        $this->unisender = $unisender;
    }

    /**
     * @param Subscribed $event
     */
    public function handle(Subscribed $event)
    {
        $subscription = $event->subscription;

        $this->unisender->importContacts([
            'field_names' => [
                'Name', 'email', 'email_status'
            ],
            'data' => [
                [
                    $subscription->name,
                    $subscription->email,
                    'active'
                ]
            ]
        ]);
    }
}
