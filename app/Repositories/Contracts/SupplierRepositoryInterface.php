<?php

namespace App\Repositories\Contracts;

use App\Models\Contact;

interface SupplierRepositoryInterface
{
    public function getAllSuppliers();
    public function getSupplierById($id);
    public function createSupplier(array $data);
    public function updateSupplier(Contact $supplier, array $data);
    public function destroySupplier(Contact $supplier);
}