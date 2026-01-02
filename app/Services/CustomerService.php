<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerRegistered;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Select all Customers
     * @return array
    */
    public function getAllCustomers()
    {
        return $this->customerRepository->getAllCustomers();
    }

     /**
     * Create a new customer
     * @param array $data
     * @return object
    */
    public function makeCustomer(array $data)
    {
        $customer = $this->customerRepository->createCustomer($data);

        $this->sendEmailToRegisteredCustomer($customer->email, "admin");

        return $customer;
    }

    /**
     * Get Customer by  ID
     * @param int $id
     * @return object
    */
    public function getCustomerById(int $id)
    {
        return $this->customerRepository->getCustomerById($id);
    }

    /**
     * Update a customer
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateCustomer(int $id, array $data)
    {
        $customer = $this->customerRepository->getCustomerById($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer Not Found'], 404);
        }

        $this->customerRepository->updateCustomer($customer, $data);
        return response()->json(['message' => 'Customer Updated'], 200);
    }

    /**
     * Delete a customer
     * @param int $id
     * @return json response
    */
    public function destroyCustomer(int $id)
    {
        $customer = $this->customerRepository->getCustomerById($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer Not Found'], 404);
        }

        $this->customerRepository->destroyCustomer($customer);

        return response()->json(['message' => 'Customer Deleted'], 200);
    }

    private function sendEmailToRegisteredCustomer($email)
    {
        Mail::to($email)
            ->bcc("anacnogueira@gmail.com")
            ->send(new CustomerRegistered($email, "admin"));
    }
}
