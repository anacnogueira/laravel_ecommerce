<?php

namespace App\Services;

use App\Repositories\Contracts\CountryRepositoryInterface;

class CountryService
{
    protected $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Select all Countries
     * @return array
    */
    public function getAllCountries()
    {
        return $this->countryRepository->getAllCountries();
    }

     /**
     * Create a new Country
     * @param array $data
     * @return object 
    */
    public function makeCountry(array $data)
    {
        $country = $this->countryRepository->createCountry($data);

        return $country;
    }

    /**
     * Get Country by  ID
     * @param int $id
     * @return object
    */
    public function getCountryById(int $id)
    {
        return $this->countryRepository->getCountryById($id);
    }

    /**
     * Update a Country
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateCountry(int $id, array $data)
    {
        $country = $this->countryRepository->getCountryById($id);

        if (!$country) {
            return response()->json(['message' => 'country Not Found'], 404);
        }

        $this->countryRepository->updateCountry($country, $data);
        return response()->json(['message' => 'country Updated'], 200);
    }

    /**
     * Delete a Country
     * @param int $id
     * @return json response
    */
    public function destroyCountry(int $id)
    {
        $country = $this->countryRepository->getCountryById($id);

        if (!$country) {
            return response()->json(['message' => 'Country Not Found'], 404);
        }

        $this->countryRepository->destroyCountry($country);

        return response()->json(['message' => 'Country Deleted'], 200);
    }
}