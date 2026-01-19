<?php

namespace App\Repositories;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Models\Contact;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected $entity;

    public function __construct(Contact $contact)
    {
        $this->entity = $contact;
    }

    /**
     * Get all Customers
     * @return array
     */
    public function getAllCustomers()
    {
        return $this->entity->customers()->get();
    }

    /**
     * Select Customer by ID
     * @param int $id
     * @return object
     */
    public function getCustomerById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Select Customer by E-mail
     * @param int $id
     * @return object
     */
    public function getCustomerByEmail($email)
    {
        return $this->entity->customers()->where('email',$email)->first();
    }

    /**
     * Create a new Customer
     * @param array $data
     * @return object
     */
    public function createCustomer(array $data)
    {
        return $this->entity->create($data);
    }

    /**
    * Update data of customer
    * @param object $contact
    * @param array $data
    * @return object
    */
    public function updateCustomer(Contact $contact, array $data)
    {
        return $contact->update($data);
    }

    /**
     * Delete a customer
     * @param object $contact
     */
    public function destroyCustomer(Contact $contact)
    {
        return $contact->delete();
    }
}
