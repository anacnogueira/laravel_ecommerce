<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use Exception;

class CustomerActivationService
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;

    }

    public function activateCustomer(int $customerId)
    {
        $customer = $this->customerRepository->getCustomerById($customerId);

        if (!$customer) {
            throw new Exception("Cliente não encontrado.");
        }

        if ($customer->status == 'S' && $customer->email_verified_at !== null) {
            return 'S';
        }

        return $this->customerRepository->markAsActive($customer);
    }
}
