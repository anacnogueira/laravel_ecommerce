<?php

namespace App\Repositories;

use App\Repositories\Contracts\EventDateRepositoryInterface;
use App\Models\EventDate;

class EventDateRepository implements EventDateRepositoryInterface
{
    protected $entity;

    public function __construct(EventDate $eventDate)
    {
        $this->entity = $eventDate;
    }

    /**
     * Create a new Event Date
     * @param array $data
     * @return object
     */
    public function createEventDate(array $data)
    {
        return $this->entity->create($data);
    }
}
