<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SampleApprovedNotification extends Notification
{
    use Queueable;

    protected $sample;

    public function __construct($sample)
    {
        $this->sample = $sample;
    }

    /**
     * Store in database + send email
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Email Notification
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Sample Approved')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('A sample has been approved by QA.')
            ->line('Sample No : '.$this->sample->sample_number)
            ->action('View Sample', route('samples.show', $this->sample->id))
            ->line('Thank you for using QA/QC Management System.');
    }

    /**
     * Database Notification
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Sample Approved',
            'message' => 'Sample '.$this->sample->sample_number.' has been approved.',
            'sample_id' => $this->sample->id,
            'url' => route('samples.show', $this->sample->id),
            'icon' => 'bi-check-circle-fill',
            'color' => 'success',
        ];
    }
}