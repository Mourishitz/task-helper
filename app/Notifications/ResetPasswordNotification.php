<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $minutes = config('auth.passwords'.config('auth.defaults.passwords').'.expire');
        return (new MailMessage)
                    ->subject('Atualização de Senha')
                    ->greeting("Olá, {$this->name}")
                    ->line('Você solicitou uma atualização de senha!')
                    ->action('Clique aqui para modificar sua senha',
                        url("/password/reset/{$this->token}?email={$this->email}"))
                    ->line("Este link expira em {$minutes} minutos")
                    ->line('Caso você não tenha requisitado uma alteração de senha, nenhuma ação é necessária.')
                    ->salutation('Até breve!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
