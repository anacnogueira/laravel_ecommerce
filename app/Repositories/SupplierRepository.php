<?php

namespace App\Repositories;

use App\Repositories\Contracts\SupplierRepositoryInterface;
use App\Models\Contact;

class SupplierRepository implements SupplierRepositoryInterface
{
    protected $entity;

    public function __construct(Contact $supplier)
    {
        $this->entity = $supplier;
    }

    /**
     * Get all Suppliers
     * @return array
     */
    public function getAllSuppliers()
    {
        return $this->entity->suppliers()->get();
    }

    /**
     * Get all Suppliers
     * @return array
     */
    public function getActiveSuppliers()
    {
        return $this->entity->show();
    }

    /**
     * Select Supplier by ID
     * @param int $id
     * @return object
     */
    public function getSupplierById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new supplier
     * @param array $data
     * @return object
     */
    public function createSupplier(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of supplier
     * @param object $contact
     * @param array $data
     * @return object
     */
    public function updateSupplier(Contact $supplier, array $data)
    {
        return $supplier->update($data);
    }

    /**
     * Delete a supplier
     * @param object $contact
     */
    public function destroySupplier(Contact $supplier) 
    {
        return $supplier->delete();
    }
}