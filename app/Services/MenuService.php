<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Brand;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BrandResource;

class MenuService
{
    public static function makeMenuLinks()
    {
        $menu = [];

		$menu['categories'] = CategoryResource::collection(Category::tree());
		$menu['brands']     = BrandResource::collection(Brand::menu());

		return $menu;
    }
}
