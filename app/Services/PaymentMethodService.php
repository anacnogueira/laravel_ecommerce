<?php

namespace App\Services;

use App\Repositories\Contracts\PaymentMethodRepositoryInterface;
use App\Services\StoreFileService;
use Illuminate\Support\Str;

class PaymentMethodService
{
    protected $paymentmethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * Select all paymentmethods
     * @return array
    */
    public function getAllPaymentMethods()
    {
        return $this->paymentMethodRepository->getAllPaymentMethods();
    }

     /**
     * Create a new paymentmethod
     * @param array $data
     * @return object 
    */
    public function makePaymentMethod(array $data, $file)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $paymentMethod = $this->paymentMethodRepository->createPaymentMethod($data);

        $fileName = Str::kebab($paymentmethod->name)."-".date('dmYHis');

        if($file) {
            $storeFileService = new StoreFileService(
                $file,
                "public/images/payment-methods",
                $fileName
            );
            $pathFile = $storeFileService->upload();
            $paymentMethod->update([
                "image" => $pathFile,
            ]);
        }        

        return $paymentMethod;
    }

    /**
     * Get PaymentMethod by  ID
     * @param int $id
     * @return object
    */
    public function getPaymentMethodById(int $id)
    {
        return $this->paymentMethodRepository->getPaymentMethodById($id);
    }

    /**
     * Update a paymentmethod
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updatePaymentMethod(int $id, array $data, $file)
    {
   
        $paymentmethod = $this->paymentMethodRepository->getPaymentMethodById($id);

        if (!$paymentmethod) {
            return response()->json(['message' => 'Payment Method Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        

        //To Do: Update image

        $this->paymentMethodRepository->updatePaymentMethod($paymentmethod, $data);
        return response()->json(['message' => 'Payment Method Updated'], 200);
    }

    /**
     * Delete a paymentmethod
     * @param int $id
     * @return json response
    */
    public function destroyPaymentMethod(int $id)
    {
        $paymentmethod = $this->paymentMethodRepository->getPaymentMethodById($id);

        if (!$paymentmethod) {
            return response()->json(['message' => 'Payment Method Not Found'], 404);
        }

        $this->paymentMethodRepository->destroyPaymentMethod($paymentmethod);

        return response()->json(['message' => 'Payment Method Deleted'], 200);
    }
}