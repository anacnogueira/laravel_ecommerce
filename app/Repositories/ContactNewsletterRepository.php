<?php

namespace App\Repositories;

use App\Repositories\Contracts\ContactNewsletterRepositoryInterface;
use App\Models\ContactNewsletter;

class ContactNewsletterRepository implements ContactNewsletterRepositoryInterface
{
    protected $entity;

    public function __construct(ContactNewsletter $contactNewsletter)
    {
        $this->entity = $contactNewsletter;
    }

    /**
     * Get all Contact Newsletters
     * @return array
     */
    public function getAllContactNewsletters()
    {
        return $this->entity->all();
    }

    /**
     * Select Contact Newsletter by ID
     * @param int $id
     * @return object
     */
    public function getContactNewsletterById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new contact Newsletter
     * @param array $data
     * @return object
     */
    public function createContactNewsletter(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Contact Newsletter
     * @param object $contactNewsletter
     * @param array $data
     * @return object
     */
    public function updateContactNewsletter(ContactNewsletter $contactNewsletter, array $data)
    {
        return $contactNewsletter->update($data);
    }

    /**
     * Delete a contact newsletter
     * @param object $contactNewsletter
     */
    public function destroyContactNewsletter(ContactNewsletter $contactNewsletter)
    {
        return $contactNewsletter->delete();
    }
}
