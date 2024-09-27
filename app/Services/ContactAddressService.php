<?php

namespace App\Services;

use App\Repositories\Contracts\ContactAddressRepositoryInterface;

class ContactAddressService
{
    protected $contactAddressRepository;

    public function __construct(ContactAddressRepositoryInterface $contactAddressRepository)
    {
        $this->contactAddressRepository = $contactAddressRepository;
    }

    /**
     * Select all Contact Address By Contact Id
     * @return array
    */
    public function getAllContactAddressesByContactId($contactId)
    {
        return $this->contactAddressRepository->getAllBanners($contactId);
    }


    /**
     * Create a new Contact Address
     * @param array $data
     * @return object 
    */
    public function makeContactAddress(array $data)
    {
        $contactAdress = $this->contactAddressRepository->createContactAddress($data);        

        return $contactAdress;
    }

    /**
     * Get ContactAddress by ID
     * @param int $id
     * @return object
    */
    public function getContactAddressById(int $id)
    {
        return $this->contactAddressRepository->getContactAddressById($id);
    }

    /**
     * Update a ContactAddress
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateContactAddress(int $id, array $data)
    {
   
        $contactAddress = $this->contactAddressRepository->getContactAddressById($id);

        if (!$contactAddress) {
            return response()->json(['message' => 'Contact Address Not Found'], 404);
        }

        $this->contactAddressRepository->updateContactAddress($contactAddress, $data);
        return response()->json(['message' => 'Contact Address Updated'], 200);
    }

    /**
     * Delete a ContactAddress
     * @param int $id
     * @return json response
    */
    public function destroyContactAddress(int $id)
    {
        $contactAddress = $this->contactAddressRepository->getContactAddressById($id);

        if (!$contactAddress) {
            return response()->json(['message' => 'Banner Not Found'], 404);
        }

        $this->contactAddressRepository->destroyContactAddress($contactAddress);

        return response()->json(['message' => 'Contact Address Deleted'], 200);
    }

}
