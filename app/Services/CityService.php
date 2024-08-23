<?php

namespace App\Services;

use App\Repositories\Contracts\CityRepositoryInterface;

class CityService
{
    protected $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Select all Citys
     * @return array
    */
    public function getAllCities()
    {
        return $this->cityRepository->getAllCities();
    }

     /**
     * Create a new City
     * @param array $data
     * @return object 
    */
    public function makeCity(array $data)
    {
        $city = $this->cityRepository->createCity($data);

        return $city;
    }

    /**
     * Get City by  ID
     * @param int $id
     * @return object
    */
    public function getCityById(int $id)
    {
        return $this->cityRepository->getCityById($id);
    }

    /**
     * Update a City
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateCity(int $id, array $data)
    {
        $city = $this->cityRepository->getCityById($id);

        if (!$city) {
            return response()->json(['message' => 'city Not Found'], 404);
        }

        $this->cityRepository->updateCity($city, $data);
        return response()->json(['message' => 'city Updated'], 200);
    }

    /**
     * Delete a City
     * @param int $id
     * @return json response
    */
    public function destroyCity(int $id)
    {
        $city = $this->cityRepository->getCityById($id);

        if (!$city) {
            return response()->json(['message' => 'City Not Found'], 404);
        }

        $this->cityRepository->destroyCity($city);

        return response()->json(['message' => 'City Deleted'], 200);
    }
}