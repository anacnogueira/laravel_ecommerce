<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerRegistered;
use Illuminate\Support\Facades\Hash;

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
    public function makeCustomer(array $data, $method)
    {
        $data = $this->dataSanitization($data);
        $data["newsletter"] = isset($data["newsletter"]) ? 'S' : 'N';
        $data["privacy"] = isset($data["newsletter"]) ? 'S' : 'N';
        $data['password']= Hash::make($data['password']);

        $customer = $this->customerRepository->createCustomer($data);

        $this->sendEmailToRegisteredCustomer($customer->email, $method);

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
     * Get Customer by email
     * @param int $id
     * @return object
    */
    public function getCustomerByEmail(string $email)
    {
        return $this->customerRepository->getCustomerByEmail($email);
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

    private function dataSanitization ($data)
    {
        if ($data["type_person"] ==="pf") {
            unset($data["fantasy_name"], $data['cnpj'], $data['ie']);
        }

        if ($data["type_person"] ==="pj") {
            unset($data["cpf"], $data["gender"], $data["date_birth"]);
        }

        return $data;

    }
}
