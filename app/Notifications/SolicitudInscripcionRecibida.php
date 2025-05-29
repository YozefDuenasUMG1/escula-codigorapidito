<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SolicitudInscripcionRecibida extends Notification implements ShouldQueue
{
    use Queueable;

    public $solicitud;

    /**
     * Create a new notification instance.
     */
    public function __construct($solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nueva solicitud de inscripción de usuario')
            ->greeting('¡Nueva solicitud de inscripción!')
            ->line('Un usuario ha solicitado su inscripción con los siguientes datos:')
            ->line('Nombre: ' . $this->solicitud->nombre)
            ->line('Email: ' . $this->solicitud->email)
            ->line('Número: ' . $this->solicitud->numero)
            ->line('Dirección: ' . $this->solicitud->direccion)
            ->line('Sucursal ID: ' . $this->solicitud->id_sucursal)
            ->line('Curso ID: ' . $this->solicitud->id_curso)
            ->line('Nivel ID: ' . $this->solicitud->id_nivel)
            ->line('Puedes gestionar esta solicitud desde el panel de administración.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'solicitud_id' => $this->solicitud->id,
            'nombre' => $this->solicitud->nombre,
            'email' => $this->solicitud->email,
        ];
    }
}
