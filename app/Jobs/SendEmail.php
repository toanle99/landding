<?php

namespace App\Jobs;

use Mail;
use App\Mail\MailNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data; 
    protected $to;
    protected $title;
    protected $from;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data, $from, $to, $title)
    {
        $this->data  = $data; 
        $this->from  = $from;
        $this->to = $to;
        $this->title = $title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        Mail::to($this->to)->send(new MailNotify($this->data, $this->from, $this->title));
    }
}