<?php

namespace App\Services;

use App\Repositories\Contracts\EventRepositoryInterface;
use App\Services\StoreFileService;
use App\Services\DeleteFileService;
use App\Services\EventDateService;
use Illuminate\Support\Str;

class EventService
{
    protected $eventRepository;
    protected $eventDateService;

    public function __construct(
        EventRepositoryInterface $eventRepository,
        EventDateService $eventDateService)
    {
        $this->eventRepository = $eventRepository;
        $this->eventDateService = $eventDateService;
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
    public function makeEvent(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["show_map"] = isset($data["show_map"]) ? 'S' : 'N';
        $data["show_link_map"] = isset($data["show_link_map"]) ? 'S' : 'N';

        $event = $this->eventRepository->createEvent($data);

        //Image
        if (isset($data["upload"])) {
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $destination = env('FILE_DESTINATION_EVENTS');
            $pathFile = $this->storeImage($data["upload"], $filename, $destination);

            $event->update([
                "image" => $pathFile,
            ]);
        }

        //Profissional Photo
        if (isset($data["professional_photo"])) {
            $filename = Str::slug($data["name"])."-".Str::slug($data["professional_name"])."-".date('dmYHis');
            $destination = env('FILE_DESTINATION_EVENT_PROFESSIONAL_PHOTOS');
            $pathFile = $this->storeImage($data["professional_photo"], $filename, $destination);

            $event->update([
                "professional_photo" => $pathFile,
            ]);
        }

        // EventDates
        $data["event_id"] = $event->id;
        $dataEventDates = json_decode($data["all_event_dates"], true);

        if (!empty($dataEventDates)) {
            foreach ($dataEventDates as $eventDate) {
                $eventDate["event_id"] =  $data["event_id"];
                $this->eventDateService->makeEventDate($eventDate);
            }
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
    public function updateEvent(int $id, array $data)
    {

        $event = $this->eventRepository->getEventById($id);

        if (!$event) {
            return response()->json(['message' => 'Event Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';
        $data["show_map"] = isset($data["show_map"]) ? 'S' : 'N';
        $data["show_link_map"] = isset($data["show_link_map"]) ? 'S' : 'N';

        //Image
        if (isset($data["upload"])) {
            $oldFile = $event->image;
            $filename = Str::slug($data["name"])."-".date('dmYHis');
            $destination = env('FILE_DESTINATION_EVENTS');
            $pathFile = $this->storeImage($data["upload"], $filename, $destination, $oldFile);

            $event->update([
                "image" => $pathFile,
            ]);
        }

        //Profissional Photo
        if (isset($data["professional_photo"])) {
            $oldFile = $event->professional_photo;
            $filename = Str::slug($data["name"])."-".Str::slug($data["professional_name"])."-".date('dmYHis');
            $destination = env('FILE_DESTINATION_EVENT_PROFESSIONAL_PHOTOS');
            $pathFile = $this->storeImage($data["professional_photo"], $filename, $destination, $oldFile);

            $event->update([
                "professional_photo" => $pathFile,
            ]);
        }

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

        if ($event->image) {
            DeleteFileService::delete($event->image);
        }

        if ($event->professional_photo) {
            DeleteFileService::delete($event->professional_photo);
        }

        $this->eventRepository->destroyEvent($event);

        return response()->json(['message' => 'Event Deleted'], 200);
    }

    private function storeImage($file, $filename, $destination, $oldFile = null)
    {
        if ($oldFile) {
            DeleteFileService::delete($oldFile);
        }

        $storeFileService = new StoreFileService(
            $file,
            $destination,
            $filename
        );
        $pathFile = $storeFileService->upload();

        return $pathFile;
    }
}
