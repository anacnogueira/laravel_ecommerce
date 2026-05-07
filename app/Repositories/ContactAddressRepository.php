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
     * Get Last Contact Addresses By ContactId
     * @return array
     */
    public function getDefaultContactAddressesByContactId($contactId)
    {
        if (session()->get('contact_address_id')) {
            $id = session()->get('contact_address_id');
            session()->forget('contact_address_id');
            return $this->entity
                ->where('contact_id', $contactId)
                ->where('id', $id)
                ->first();
        }

        return $this->entity->where('contact_id', $contactId)->latest()->first();
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
     * Select Contact Address by ID and Contact ID
     * @param int $id
     * @return object
     */
    public function getContactAddressByIdAndContactId($id, $contactId)
    {
        return $this->entity
            ->where('id',$id)
            ->where('contact_id', $contactId)
            ->first();
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
