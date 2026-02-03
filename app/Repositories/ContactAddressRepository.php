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
    public function getAllContactAddressesByContactId($contactId, $queryParams = null)
    {
        $addresses =$this->entity->where('contact_id', $contactId);

         if (isset($queryParams["conditions"])) {
            foreach ($queryParams["conditions"] as $condition) {
                if ($condition["operator"]!= "between") {
                    $addresses = $addresses->where($condition["column"], $condition["operator"], $condition["value"]);
                } else {
                    $addresses = $addresses->whereBetween($condition["column"], $condition["value"]);
                }

            }
        }

        if ($queryParams['sort'] && $queryParams['direction']) {
            $addresses = $addresses->orderBy($queryParams['sort'], $queryParams['direction']);
        }

        $addresses = !empty($queryParams['paginate']) ?
            $addresses->paginate($queryParams['paginate']) :
            $addresses->get();

        return $addresses;
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
