<?php

namespace App\Notifications\Student;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBookAdded extends Notification
{
    use Queueable;
    protected $bookId;
    protected $bookTitle;
    protected $teacherName;

    public function __construct($bookId, $bookTitle, $teacherName)
    {
        $this->bookId = $bookId;
        $this->bookTitle = $bookTitle;
        $this->teacherName = $teacherName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'new book added',
            'body' => 'teacher ' . $this->teacherName . ' added new book: ' . $this->bookTitle,
            'url' => route('student.library.preview', $this->bookId)    // url to redirect to reading the notification details
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
