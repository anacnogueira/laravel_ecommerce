<?php

namespace App\Services;

use App\Repositories\Contracts\ContactNewsletterRepositoryInterface;
use App\Services\CustomerService;
use App\Services\MailchimpService;

class ContactNewsletterService
{
    protected $contactNewsletterRepository;
    protected $customerService;
    protected $mailchimpService;

    public function __construct(
        ContactNewsletterRepositoryInterface $contactNewsletterRepository,
        CustomerService $customerService,
        MailchimpService $mailchimpService
    )
    {
        $this->contactNewsletterRepository = $contactNewsletterRepository;
        $this->customerService = $customerService;
        $this->mailchimpService = $mailchimpService;
    }

    /**
     * Select all Contact Newsletters
     * @return array
    */
    public function getAllContactNewsletters()
    {
        return $this->contactNewsletterRepository->getAllContactNewsletters();
    }

    /**
     * Create a new Contact Newsletter
     * @param array $data
     * @return object
    */
    public function makeContactNewsletter(array $data)
    {
        $customerName = null;
        $contactNewsletter = $this->contactNewsletterRepository->createContactNewsletter($data);

        if (isset($data["contact_id"])) {
            $customer = $this->customerService->getCustomerById($data["contact_id"]);
            $customerName = $customer->name;
        }

        $this->mailchimpService->addSubscriber($data["email"], $customerName);

        return $contactNewsletter;
    }

    /**
     * Get ContactNewsletter by ID
     * @param int $id
     * @return object
    */
    public function getContactNewsletterById(int $id)
    {
        return $this->contactNewsletterRepository->getContactNewsletterById($id);
    }

    /**
     * Update a ContactNewsletter
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateContactNewsletter(int $id, array $data)
    {

        $contactNewsletter = $this->contactNewsletterRepository->getContactNewsletterById($id);

        if (!$contactNewsletter) {
            return response()->json(['message' => 'Contact Newsletter Not Found'], 404);
        }

        $newsletter = $this->getContactNewsletterById($id);
        $oldEmail = $newsletter->email;
        $newEmail = $data["email"];
        $customerName = '';

        if ($data["contact_id"]) {
            $customer = $this->customerService->getCustomerById($data["contact_id"]);
            $customerName = $customer->name;
        }

        $this->mailchimpService->editSubscriber($oldEmail, $newEmail, $customerName);

        $this->contactNewsletterRepository->updateContactNewsletter($contactNewsletter, $data);

        return response()->json(['message' => 'Contact Newsletter Updated'], 200);
    }

    /**
     * Delete a ContactNewsletter
     * @param int $id
     * @return json response
    */
    public function destroyContactNewsletter(int $id)
    {
        $contactNewsletter = $this->contactNewsletterRepository->getContactNewsletterById($id);

        if (!$contactNewsletter) {
            return response()->json(['message' => 'Contact Newsletter Not Found'], 404);
        }

        $this->mailchimpService->removeSubscriber($contactNewsletter->email);

        $this->contactNewsletterRepository->destroyContactNewsletter($contactNewsletter);

        return response()->json(['message' => 'Contact Newsletter Deleted'], 200);
    }

}
