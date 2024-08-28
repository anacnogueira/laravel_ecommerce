<?php

namespace App\Services;

use App\Repositories\Contracts\EventRepositoryInterface;
use App\Services\StoreFileService;
use Illuminate\Support\Str;

class EventService
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Select all events
     * @return array
    */
    public function getAllEvents()
    {
        return $this->eventRepository->getAllEvents();
    }

     /**
     * Create a new event
     * @param array $data
     * @return object 
    */
    public function makeEvent(array $data, $file)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $event = $this->eventRepository->createEvent($data);

        $fileName = Str::kebab($event->name)."-".date('dmYHis');

        if($file) {
            $storeFileService = new StoreFileService(
                $file,
                "public/images/events",
                $fileName
            );
            $pathFile = $storeFileService->upload();
            $event->update([
                "image" => $pathFile,
            ]);
        }        

        return $event;
    }

    /**
     * Get Event by  ID
     * @param int $id
     * @return object
    */
    public function getEventById(int $id)
    {
        return $this->eventRepository->getEventById($id);
    }

    /**
     * Update a event
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateEvent(int $id, array $data, $file)
    {
   
        $event = $this->eventRepository->getEventById($id);

        if (!$event) {
            return response()->json(['message' => 'Event Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';        

        //To Do: Update image

        $this->eventRepository->updateEvent($event, $data);
        return response()->json(['message' => 'Event Updated'], 200);
    }

    /**
     * Delete a event
     * @param int $id
     * @return json response
    */
    public function destroyEvent(int $id)
    {
        $event = $this->eventRepository->getEventById($id);

        if (!$event) {
            return response()->json(['message' => 'Event Not Found'], 404);
        }

        $this->eventRepository->destroyEvent($event);

        return response()->json(['message' => 'Event Deleted'], 200);
    }
}