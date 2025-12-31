<?php

namespace App\Repositories;

use App\Repositories\Contracts\ContactInfoRepositoryInterface;
use App\Models\ContactInfo;

class ContactInfoRepository implements ContactInfoRepositoryInterface
{
    protected $entity;

    public function __construct(ContactInfo $city)
    {
        $this->entity = $city;
    }

    /**
     * Create a new Contact Info
     * @param array $data
     * @return object
     */
    public function createContactInfo(array $data)
    {
        return $this->entity->create($data);
    }
}
