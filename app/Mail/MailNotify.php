<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
   use Queueable, SerializesModels;

   public $data; 
   public $title;
   public $fromd;

    public function __construct($data, $fromd, $title)
    {
        $this->data = $data;
        $this->fromd = $fromd;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromd)->view('mails.mail-notify')->subject($this->title);
    }
}
