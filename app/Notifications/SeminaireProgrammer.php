<?php
namespace App\Notifications;

use App\Models\Seminaire;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SeminaireProgrammer extends Notification
{
    use Queueable;

    protected $seminaire;

    public function __construct(Seminaire $seminaire)
    {
        $this->seminaire = $seminaire;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('seminaires.show', $this->seminaire->slug);

        return (new MailMessage)
                    ->subject('Nouveau Séminaire Programmé : ' . $this->seminaire->title)
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Un nouveau séminaire a été programmé.')
                    ->line('Titre : **' . $this->seminaire->title . '**')
                    ->line('Présenté par : **' . $this->seminaire->presentateur->name . '**')
                    ->line('Date : **' . $this->seminaire->date_de_presentation->format('d/m/Y') . '**')
                    ->action('Voir les détails du séminaire', $url)
                    ->line('Merci de votre attention.');
    }
}