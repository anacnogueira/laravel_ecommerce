<?php

namespace App\Repositories\Contracts;

use App\Models\City;

interface CityRepositoryInterface
{
    public function getAllCities();
    public function getCityById($id);
    public function createCity(array $data);
    public function updateCity(City $city, array $data);
    public function destroyCity(City $city);
}