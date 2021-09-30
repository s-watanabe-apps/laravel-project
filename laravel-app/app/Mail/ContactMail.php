<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $data;
    protected $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $data, $template)
    {
        $this->title = $title;
        $this->data = $data;
        $this->template = $template;
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
            ->subject($this->title)
            ->with($this->data);
    }
}
