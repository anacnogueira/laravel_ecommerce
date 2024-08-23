<?php

namespace App\Repositories;

use App\Repositories\Contracts\CityRepositoryInterface;
use App\Models\City;

class CityRepository implements CityRepositoryInterface
{
    protected $entity;

    public function __construct(City $city)
    {
        $this->entity = $city;
    }

    /**
     * Get all Citys
     * @return array
     */
    public function getAllCities()
    {
        return $this->entity->all();
    }    

    /**
     * Select City by ID
     * @param int $id
     * @return object
     */
    public function getCityById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new City
     * @param array $data
     * @return object
     */
    public function createCity(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of City
     * @param object $city
     * @param array $data
     * @return object
     */
    public function updateCity(City $city, array $data)
    {
        return $city->update($data);
    }

    /**
     * Delete a City
     * @param object $city
     */
    public function destroyCity(City $city) 
    {
        return $city->delete();
    }
}