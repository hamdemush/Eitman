<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtpNotification extends Notification
{
    use Queueable;

    protected $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
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
                    ->subject('رمز التحقق الخاص بك | منصة إطمئنان')
                    ->greeting('عزيزي المستخدم،')
                    ->line('تلقينا طلباً لتأكيد حسابك على منصة إطمئنان. يُرجى استخدام رمز التحقق الأمني الآتي لإكمال العملية:')
                    ->line('**' . $this->otp . '**')
                    ->line('تنتهي صلاحية هذا الرمز خلال **10 دقائق** فقط.')
                    ->line('⚠️ **تنبيه أمني:** لحماية حسابك، لا تشارك هذا الرمز مع أي شخص. فريق إطمئنان لن يطلب منك هذا الرمز تحت أي ظرف.')
                    ->line('إذا لم تكن قد قمت بإنشاء هذا الطلب، يُرجى تجاهل هذه الرسالة.')
                    ->salutation("مع فائق الاحترام،\nفريق الحماية والأمان — منصة إطمئنان");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}