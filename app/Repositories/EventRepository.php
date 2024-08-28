<?php

namespace App\Repositories;

use App\Repositories\Contracts\EventRepositoryInterface;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    protected $entity;

    public function __construct(Event $event)
    {
        $this->entity = $event;
    }

    /**
     * Get all Events
     * @return array
     */
    public function getAllEvents()
    {
        return $this->entity->all();
    }

    /**
     * Get all Events
     * @return array
     */
    public function getActiveEvents()
    {
        return $this->entity->show();
    }

    /**
     * Select Event by ID
     * @param int $id
     * @return object
     */
    public function getEventById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new event
     * @param array $data
     * @return object
     */
    public function createEvent(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of event
     * @param object $event
     * @param array $data
     * @return object
     */
    public function updateEvent(Event $event, array $data)
    {
        return $event->update($data);
    }

    /**
     * Delete a event
     * @param object $event
     */
    public function destroyEvent(Event $event) 
    {
        return $event->delete();
    }
}