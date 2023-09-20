<?php

namespace App\Notifications;

use App\Models\Classwork;
use App\Notifications\Channels\HadaraSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;

class NewClassworkNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Classwork $classwork)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Cannels: mail, database, Broadcast, vonage(sms), slack
        return [
            'database',
            HadaraSmsChannel::class,
            'mail',
            'broadcast',
            // 'vonage'
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toVonage(object $notifiable)
    {
        return (new VonageMessage)->content(__('A new classwork created!'));
    }
    public function toHadara(object $notifiable)
    {
        return __('A new classwork created!');
    }
    public function toMail(object $notifiable): MailMessage
    {
        $classwork = $this->classwork;
        $content = __(':name posted a new :type: :title', [
            'name' => $classwork->user->name,
            'type' => __($classwork->type->value),
            'title' => __($classwork->title),
        ]);
        return (new MailMessage)
            ->subject(__('New :type', ['type' => $this->classwork->type->value]))
            ->greeting(__('Hello :name', ['name' => $notifiable->name]))
            ->line($content)
            ->action(__('Go to classwork'), route('classroom.classwork.show', [
                $classwork->classroom_id,
                $classwork->id,
            ]))
            ->line('Thank you for using our application!');
    }
    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage($this->toArray($notifiable));
    }
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $classwork = $this->classwork;
        $content = __(':name posted a new :type: :title', [
            'name' => $classwork->user->name,
            'type' => __($classwork->type->value),
            'title' => __($classwork->title),
        ]);
        return [
            'title' => __('New :type', ['type' => $this->classwork->type->value]),
            'body' => $content,
            'image' => '',
            'link' => route('classroom.classwork.show', [
                $classwork->classroom_id,
                $classwork->id,
            ]),
            'classwork_id' => $classwork->id,
        ];
    }
}
