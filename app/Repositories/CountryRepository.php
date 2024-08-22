<?php

namespace App\Repositories;

use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Models\Country;

class CountryRepository implements CountryRepositoryInterface
{
    protected $entity;

    public function __construct(Country $country)
    {
        $this->entity = $country;
    }

    /**
     * Get all Countrys
     * @return array
     */
    public function getAllCountries()
    {
        return $this->entity->all();
    }

    /**
     * Select Country by ID
     * @param int $id
     * @return object
     */
    public function getCountryById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Country
     * @param array $data
     * @return object
     */
    public function createCountry(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Country
     * @param object $country
     * @param array $data
     * @return object
     */
    public function updateCountry(Country $country, array $data)
    {
        return $country->update($data);
    }

    /**
     * Delete a Country
     * @param object $country
     */
    public function destroyCountry(Country $country) 
    {
        return $country->delete();
    }
}