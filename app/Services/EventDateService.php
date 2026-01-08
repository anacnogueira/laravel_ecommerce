<?php

namespace App\Services;

use App\Repositories\Contracts\EventDateRepositoryInterface;

class EventDateService
{

    protected $eventDateRepository;

    public function __construct(EventDateRepositoryInterface $eventDateRepository)
    {
        $this->eventDateRepository = $eventDateRepository;
    }

    /**
     * Create a new Event Date
     * @param array $data
     * @return object
    */
    public function makeEventDate(array $data)
    {
        $eventDate = $this->eventDateRepository->createEventDate($data);

        return $eventDate;
    }
}
