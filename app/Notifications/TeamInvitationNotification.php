<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
class TeamInvitationNotification extends Notification
{
    use Queueable;

    protected $team;

    public function __construct($team)
    {
        $this->team = $team;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'invitations.accept', // nombre de la ruta
            now()->addDays(2),    // tiempo de expiración
            [
                'invitation' => encrypt($this->team->id), // puedes cifrar el ID por seguridad
            ]
        );
    
        return (new MailMessage)
            ->subject('Has sido invitado a un equipo')
            ->greeting("Hola {$notifiable->name},")
            ->line("Te han invitado al equipo: {$this->team->name}")
            ->action('Aceptar invitación', $url)
            ->line('Gracias por usar nuestra aplicación.');
    }
}
