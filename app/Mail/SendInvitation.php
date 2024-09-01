<?php

namespace Acelle\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvitation extends Mailable
{
    use Queueable, SerializesModels;
    
    public $layoutContent;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($layoutContent, $subject)
    {
        $this->layoutContent = $layoutContent;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have been invited to join a '.\Acelle\Model\Setting::get("site_name").' account')->from(\Acelle\Model\Setting::get("mailer.from.address"), \Acelle\Model\Setting::get('site_name').' Team')->html($this->layoutContent);
    }
}
