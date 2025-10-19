<?php

namespace App\Mail;

use App\Helper\TemplateHelper;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param Template $template
     */
    public function __construct(
        public $data
    )
    {
    }

    /**
     * @return ReminderEmail
     */
    public function build(): ReminderEmail
    {

        return $this
            ->subject($this->data->subject)
            ->view('emails.base_template_for_reminder')
            ->from('info@crystaldice.net');
    }
}
