<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    private $template;

    private $data;

    /**
     * Create a new message instance.
     *
     * @param $subject
     * @param $template
     * @param $data
     * @return void
     */
    public function __construct($subject, $template, $data = null)
    {
        $this->subject = $subject;
        $this->template = $template;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@test.com')
            ->view($this->template)
            ->subject($this->subject)
            ->with($this->data);
    }
}
