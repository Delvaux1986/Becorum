<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class NewCommentPosted extends Notification
{
    use Queueable;

    protected $user;
    protected $topic;
    protected $table = 'notifications';
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Topic $topic,User $user)
    {
        $this->topic = $topic;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'topicTitle' => $this->topic->title,
            'topicId' => $this->topic->id,
            'username' => $this->user->name 
        ];
    }
    
}
