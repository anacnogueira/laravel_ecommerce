<?php

namespace App\Repositories\Contracts;

use App\Models\Country;

interface CountryRepositoryInterface
{
    public function getAllCountries();
    public function getCountryById($id);
    public function createCountry(array $data);
    public function updateCountry(Country $Country, array $data);
    public function destroyCountry(Country $Country);
}