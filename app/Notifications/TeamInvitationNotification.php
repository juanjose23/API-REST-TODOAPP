<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
class TeamInvitationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $invitation;

    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $team = $this->invitation->team;
        $frontUrl = env('FRONT_URL');

        return (new MailMessage)
            ->subject('Has sido invitado a un equipo')
            ->greeting("Hola {$notifiable->name},")
            ->line("Te han invitado al equipo: {$team->name}")
            ->action('Unirse al equipo', url("{$frontUrl}/teams/invite?token={$this->invitation->token}"))
            ->line('Gracias por usar nuestra aplicación.');
    }
}
