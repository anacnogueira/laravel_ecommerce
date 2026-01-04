<?php

namespace App\Services;

use App\Repositories\Contracts\PaymentMethodRepositoryInterface;
use Illuminate\Support\Str;
use App\Services\StoreFileService;
use App\Services\DeleteFileService;

class PaymentMethodService
{
    protected $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * Select all payment Methods
     * @return array
    */
    public function getAllPaymentMethods()
    {
        return $this->paymentMethodRepository->getAllPaymentMethods();
    }

     /**
     * Create a new payment Method
     * @param array $data
     * @return object
    */
    public function makePaymentMethod(array $data)
    {
        $data["status"] = isset($data["status"]) ? 1 : 0;

        $paymentMethod = $this->paymentMethodRepository->createPaymentMethod($data);

        if (isset($data["upload"])) {
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename);

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
    public function updatePaymentMethod(int $id, array $data)
    {
        $paymentMethod = $this->paymentMethodRepository->getPaymentMethodById($id);

        if (!$paymentMethod) {
            return response()->json(['message' => 'Payment Method Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 1 : 0;

        if ( $data["upload"]) {
            $oldFile = $paymentMethod->image;
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename, $oldFile);

            $data["image"] = $pathFile;
        }

        $this->paymentMethodRepository->updatePaymentMethod($paymentMethod, $data);
        return response()->json(['message' => 'Payment Method Updated'], 200);
    }

    /**
     * Delete a payment Method
     * @param int $id
     * @return json response
    */
    public function destroyPaymentMethod(int $id)
    {
        $paymentMethod = $this->paymentMethodRepository->getPaymentMethodById($id);

        if (!$paymentMethod) {
            return response()->json(['message' => 'Payment Method Not Found'], 404);
        }

         if ($paymentMethod->image) {
            DeleteFileService::delete($paymentMethod->image);
        }

        $this->paymentMethodRepository->destroyPaymentMethod($paymentMethod);

        return response()->json(['message' => 'Payment Method Deleted'], 200);
    }

    private function storeImage($file, $filename, $oldFile = null)
    {
        if ($oldFile) {
            DeleteFileService::delete($oldFile);
        }

        $storeFileService = new StoreFileService(
            $file,
            env('FILE_DESTINATION_PAYMENT_METHODS'),
            $filename
        );
        $pathFile = $storeFileService->upload();

        return $pathFile;
    }
}
