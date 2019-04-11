<?php

namespace App\Listeners\Subscription;

use App\Events\Subscription\Subscribed as SubscribedEvent;
use App\Mail\Subscribed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailAboutSubscription
{
    /**
     * @param Subscribed $event
     */
    public function handle(SubscribedEvent $event)
    {
        Mail::send(new Subscribed($event->subscriber, app()->getLocale()));
    }
}
