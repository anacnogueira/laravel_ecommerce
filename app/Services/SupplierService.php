<?php

namespace App\Services;

use App\Repositories\Contracts\SupplierRepositoryInterface;
use App\Services\StoreFileService;
use App\Services\ContactAddressService;
use App\Services\ContactInfoService;
use Illuminate\Support\Str;

class SupplierService
{
    protected $supplierRepository;
    protected $contactAddressService;
    protected $contactInfoService;

    public function __construct(
        SupplierRepositoryInterface $supplierRepository,
        ContactAddressService $contactAddressService,
        ContactInfoService $contactInfoService,
    )
    {
        $this->supplierRepository = $supplierRepository;
        $this->contactAddressService = $contactAddressService;
        $this->contactInfoService = $contactInfoService;
    }

    /**
     * Select all suppliers
     * @return array
    */
    public function getAllSuppliers()
    {
        return $this->supplierRepository->getAllSuppliers();
    }

     /**
     * Create a new supplier
     * @param array $data
     * @return object
    */
    public function makeSupplier(array $data)
    {
        //1. Cadastrar Dados Gerais e de Contato
        $supplier = $this->supplierRepository->createSupplier($data);

        if ($data["upload"]) {
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename);

            $supplier->update([
                "image" => $pathFile,
            ]);
        }

        //2. Cadastrar Dados de Endereço
        $data["contact_id"] = $supplier->id;

        $this->contactAddressService->makeContactAddress($data);

        //3. Adicionar Dados Pessoas Para Contato
        $dataContactInfos = json_decode($data["all_contact_infos"], true);

        if ($dataContactInfos){
            foreach ($dataContactInfos as $contactInfo) {
                $contactInfo["contact_id"] =  $data["contact_id"];
                $this->contactInfoService->makeContactInfo($contactInfo);
            }
        }

        return $supplier;
    }

    /**
     * Get Supplier by  ID
     * @param int $id
     * @return object
    */
    public function getSupplierById(int $id)
    {
        return $this->supplierRepository->getSupplierById($id);
    }

    /**
     * Update a supplier
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateSupplier(int $id, array $data)
    {

        $supplier = $this->supplierRepository->getSupplierById($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier Not Found'], 404);
        }

        if ( $data["upload"]) {
            $oldFile = $supplier->image;
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $pathFile = $this->storeImage($data["upload"], $filename, $oldFile);

            $data["image"] = $pathFile;
        }

        $this->supplierRepository->updateSupplier($supplier, $data);

        //Update Address
        $address = $this->contactAddressService->getAllContactAddressesByContactId($id)->first();
        $this->contactAddressService->updateContactAddress($address->id, $data);

        //Update ContactInfo
        $supplier->info()->delete();

        $dataContactInfos = json_decode($data["all_contact_infos"], true);

        foreach ($dataContactInfos as $contactInfo) {
            $contactInfo["contact_id"] =  $id;
            $this->contactInfoService->makeContactInfo($contactInfo);
        }

        return response()->json(['message' => 'Supplier Updated'], 200);
    }

    /**
     * Delete a supplier
     * @param int $id
     * @return json response
    */
    public function destroySupplier(int $id)
    {
        $supplier = $this->supplierRepository->getSupplierById($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier Not Found'], 404);
        }

        if ($supplier->image) {
            DeleteFileService::delete($supplier->image);
        }

        $supplier->address()->delete();
        $supplier->info()->delete();

        $this->supplierRepository->destroySupplier($supplier);

        return response()->json(['message' => 'Supplier Deleted'], 200);
    }

    private function storeImage($file, $filename, $oldFile = null)
    {
        if ($oldFile) {
            DeleteFileService::delete($oldFile);
        }

        $storeFileService = new StoreFileService(
            $file,
            env('FILE_DESTINATION_SUPPLIERS'),
            $filename
        );
        $pathFile = $storeFileService->upload();

        return $pathFile;
    }
}
