<?php

namespace App\Services;

use App\Repositories\Contracts\SupplierRepositoryInterface;
use App\Services\StoreFileService;
use Illuminate\Support\Str;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
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
    public function makeSupplier(array $data, $file)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        //1. Cadastrar Dados Geraia
        $supplier = $this->supplierRepository->createSupplier($data);


        //2. Cadastrar Dados de de Contato


        //3. Adicionar Dados Pessoas Para Contato

        //4. Adiciona Imagem (se houver)
        if ($file) {
            $fileName = Str::kebab($supplier->name)."-".date('dmYHis');

            $storeFileService = new StoreFileService(
                $file,
                "public/images/suppliers",
                $fileName
            );
            $pathFile = $storeFileService->upload();
            $supplier->update([
                "image" => $pathFile,
            ]);
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
    public function updateSupplier(int $id, array $data, $file)
    {
   
        $supplier = $this->supplierRepository->getSupplierById($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';        

        //To Do: Update image

        $this->supplierRepository->updateSupplier($supplier, $data);
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

        $this->supplierRepository->destroySupplier($supplier);

        return response()->json(['message' => 'Supplier Deleted'], 200);
    }
}