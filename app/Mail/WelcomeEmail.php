<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    

    public function __construct()
    {
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.emailMsgWelcome')
        ->subject('cadastro Efetuado com sucesso!!!')
        ->with([
            'user' => 'ribamar',
        ]);
      

    }
}
