<?php

namespace App\Repositories\Contracts;

use App\Models\ContactAddress;

interface ContactAddressRepositoryInterface
{
    public function getAllContactAddressesByContactId($contactId);
    public function createContactAddress(array $data);
    public function getContactAddressById($id);
    public function updateContactAddress(ContactAddress $contactAddress, array $data);
    public function destroyContactAddress(ContactAddress $contactAddress);
}
