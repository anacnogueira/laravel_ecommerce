<?php

namespace App\Repositories;

use App\Repositories\Contracts\ContactAddressRepositoryInterface;
use App\Models\ContactAddress;

class ContactAddressRepository implements ContactAddressRepositoryInterface
{
    protected $entity;

    public function __construct(ContactAddress $contactAddress)
    {
        $this->entity = $contactAddress;
    }

    /**
     * Get all Contact Addresses By ContactId
     * @return array
     */
    public function getAllContactAddressesByContactId($contactId)
    {
        return $this->entity->where('contact_id', $contactId)->get();
    }

    /**
     * Select Contact Address by ID
     * @param int $id
     * @return object
     */
    public function getContactAddressById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new contact Address
     * @param array $data
     * @return object
     */
    public function createContactAddress(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Contact Address
     * @param object $contactAddress
     * @param array $data
     * @return object
     */
    public function updateContactAddress(ContactAddress $contactAddress, array $data)
    {
        return $contactAddress->update($data);
    }

    /**
     * Delete a contact address
     * @param object $contactAddress
     */
    public function destroyContactAddress(ContactAddress $contactAddress)
    {
        return $contactAddress->delete();
    }
}
