<?php

namespace Acelle\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvitation extends Mailable
{
    use Queueable, SerializesModels;
    // public $maildata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct()
    {
        // $this->maildata = $maildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have been invited to join a Quotebiz account')->from('example@example.com', 'Quotebiz Team')->markdown('mail.send-invitation');
    }
}
