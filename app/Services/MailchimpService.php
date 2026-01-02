<?php

namespace App\Services;

use Spatie\Newsletter\Facades\Newsletter;

class MailchimpService
{
    public function addSubscriber($email, $customerName = null)
    {
        if ($customerName) {
            Newsletter::subscribe($email, ['FNAME'=> $customerName]);
            return;
        }

        Newsletter::subscribe($email);
    }

    public function editSubscriber($oldEmail, $newEmail, $customerName)
    {
        if ($oldEmail !== $newEmail) {
            $this->removeSubscriber($oldEmail);
            $this->addSubscriber($newEmail, $customerName);
        }
    }

    public function removeSubscriber($email)
    {
        Newsletter::unsubscribe($email);
    }
}
