<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class loginCredentials extends Mailable
{
     public $user;
     public $password;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password)
    {
      $this->user = $user;
      $this->password= $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.login-credentials')->subject('Tus credenciales de Acceso a ' . config('app.name'));

        //Con subject le mandamos el titulo en el correo
    }
}
