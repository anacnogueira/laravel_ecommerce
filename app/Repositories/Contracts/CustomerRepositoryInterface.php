<?php

namespace App\Repositories\Contracts;

use App\Models\Contact;

interface CustomerRepositoryInterface
{
    public function getAllCustomers();
    public function getCustomerById($id);
    public function createCustomer(array $data);
    public function updateCustomer(Contact $contact, array $data);
    public function destroyCustomer(Contact $contact);
}
