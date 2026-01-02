<?php

namespace App\Repositories\Contracts;

use App\Models\ContactNewsletter;

interface ContactNewsletterRepositoryInterface
{
    public function getAllContactNewsletters();
    public function createContactNewsletter(array $data);
    public function getContactNewsletterById($id);
    public function updateContactNewsletter(ContactNewsletter $contactNewsletter, array $data);
    public function destroyContactNewsletter(ContactNewsletter $contactNewsletter);
}
