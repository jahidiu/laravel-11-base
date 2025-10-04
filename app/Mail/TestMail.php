<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->mailData['from_address'], $this->mailData['from_name'])
            ->subject($this->mailData['subject'])
            ->view('base::mail.test_mail')
            ->with([
                'body' => $this->mailData['body'],
            ]);
    }
}
