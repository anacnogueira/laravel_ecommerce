<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Repositories\Contracts\OrderLogRepositoryInterface;
use App\Mail\OrderLogCustomerNotified;

class OrderLogService
{
    protected $orderLogRepository;

    public function __construct(OrderLogRepositoryInterface $orderLogRepository)
    {
        $this->orderLogRepository = $orderLogRepository;
    }

     /**
     * Create a new orderLog
     * @param array $data
     * @return object
    */
    public function makeOrderLog(int $orderId, array $data)
    {
        $data['order_id'] = $orderId;

        $orderLog = $this->orderLogRepository->createOrderLog($data);

        if ($data['client_notified'] === 'S') {
            $this->sendEmailToCustomer($data['email'], $orderLog);
        }

        return $orderLog;
    }

    private function sendEmailToCustomer($email, $orderLog)
    {
        Mail::to($email)
            ->bcc("anacnogueira@gmail.com")
            ->send(new OrderLogCustomerNotified($orderLog));
    }


}
