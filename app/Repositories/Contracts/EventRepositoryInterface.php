<?php

namespace App\Repositories\Contracts;

use App\Models\Event;

interface EventRepositoryInterface
{
    public function getAllEvents();
    public function getEventById($id);
    public function createEvent(array $data);
    public function updateEvent(Event $event, array $data);
    public function destroyEvent(Event $event);
}