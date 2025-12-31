<?php

namespace App\Services;

use App\Repositories\Contracts\ProductNotificationRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationSent;

class ProductNotificationService
{
    protected $productNotificationRepository;

    public function __construct(ProductNotificationRepositoryInterface $productNotificationRepository)
    {
        $this->productNotificationRepository = $productNotificationRepository;
    }

    /**
     * Create a new notification
     * @param array $data
     * @return object
    */
    public function makeNotification(array $data)
    {
        // Grava Notificação no banco
        $notification = $this->productNotificationRepository->createNotification($data);

       // Envia por e-mail
       Mail::to(env("SITE_EMAIL_DEV"))
        ->send(new NotificationSent($notification));

        return $notification;
    }
}
