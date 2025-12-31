<?php

namespace App\Services;

use App\Repositories\Contracts\ContactInfoRepositoryInterface;

class ContactInfoService
{

    protected $contactInfoRepository;

    public function __construct(ContactInfoRepositoryInterface $contactInfoRepository)
    {
        $this->contactInfoRepository = $contactInfoRepository;
    }

    /**
     * Create a new Contact Info
     * @param array $data
     * @return object
    */
    public function makeContactInfo(array $data)
    {
        $contactInfo = $this->contactInfoRepository->createContactInfo($data);

        return $contactInfo;
    }
}
