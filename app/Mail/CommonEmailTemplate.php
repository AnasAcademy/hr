<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommonEmailTemplate extends Mailable
{
    use Queueable, SerializesModels;
    public $template;
    public $settings;
    public $mailTo;
    public $attachments;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $settings, $mailTo, $attachments=[])
    {
        $this->template = $template;
        $this->settings = $settings;
        $this->mailTo = $mailTo;
        $this->attachments = $attachments;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from($this->settings['mail_from_address'], $this->settings['mail_from_name'])->markdown('email.common_email_template')->subject($this->template->subject)->with('content', $this->template->content);

        foreach ($this->attachments as $attachment) {
            $mail->attach($attachment['file']);
        };

        return $mail;
    }
}
