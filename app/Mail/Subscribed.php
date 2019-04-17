<?php

namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Subscribed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Subscription
     */
    public $subscription;

    /**
     * @var string
     */
    public $locale;

    /**
     * @param Subscription $subscription
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Спасибо за подписку на рассылку');
        $this->to($this->subscription->email);

        return $this->markdown('emails.subscribed');
    }
}
