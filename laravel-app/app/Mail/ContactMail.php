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
    protected $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $contact;

    public function __construct($title, $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@test.com')
            ->view('emails.mail_test')
            ->subject($this->title)
            ->with([
                'text' => $this->text,
            ]);
    }
}
