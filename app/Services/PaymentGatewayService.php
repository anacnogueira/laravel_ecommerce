<?php

namespace App\Services;

use App\Repositories\Contracts\PaymentGatewayRepositoryInterface;

class PaymentGatewayService
{
    protected $paymentGatewayRepository;

    public function __construct(PaymentGatewayRepositoryInterface $paymentGatewayRepository)
    {
        $this->paymentGatewayRepository = $paymentGatewayRepository;
    }

    /**
     * Select all paymentgateways
     * @return array
    */
    public function getAllPaymentGateways()
    {
        return $this->paymentGatewayRepository->getAllPaymentGateways();
    }

     /**
     * Create a new paymentgateway
     * @param array $data
     * @return object 
    */
    public function makePaymentGateway(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $paymentGateway = $this->paymentGatewayRepository->createPaymentGateway($data);        

        return $paymentgateway;
    }

    /**
     * Get PaymentGateway by  ID
     * @param int $id
     * @return object
    */
    public function getPaymentGatewayById(int $id)
    {
        return $this->paymentGatewayRepository->getPaymentGatewayById($id);
    }

    /**
     * Update a paymentgateway
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updatePaymentGateway(int $id, array $data)
    {
        $paymentGateway = $this->paymentGatewayRepository->getPaymentGatewayById($id);

        if (!$paymentGateway) {
            return response()->json(['message' => 'Payment Gateway Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $this->paymentGatewayRepository->updatePaymentGateway($paymentGateway, $data);
        return response()->json(['message' => 'Payment Gateway Updated'], 200);
    }

    /**
     * Delete a paymentgateway
     * @param int $id
     * @return json response
    */
    public function destroyPaymentGateway(int $id)
    {
        $paymentGateway = $this->paymentGatewayRepository->getPaymentGatewayById($id);

        if (!$paymentGateway) {
            return response()->json(['message' => 'Payment Gateway Not Found'], 404);
        }

        $this->paymentGatewayRepository->destroyPaymentGateway($paymentGateway);

        return response()->json(['message' => 'Payment Gateway Deleted'], 200);
    }
}