<?php

namespace Acelle\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SpecialJob extends Mailable
{
    use Queueable, SerializesModels;
    public $maildata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($maildata)
        {
            $this->maildata = $maildata;
        }

    /**
     * Build the message.
     *
     * @return $this
     */ 
   
        public function build()
    {
        return $this->markdown('emails.specialjob')->subject('⭐ '.$this->maildata['jobdetail']->user->first_name.' is looking for '.$this->maildata['jobdetail']->category->category_name)->from(\Acelle\Model\Setting::get("mailer.from.address"), \Acelle\Model\Setting::get('site_name').' Team')->with('maildata', $this->maildata);
    }
    
}
