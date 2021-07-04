<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\CityRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\WardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * CityController constructor
     * 
     * @param CityRepository $cityRepository
     * @param DistrictRepository $districtRepository
     * @param WardRepository $wardRepository
     */
    public function __construct(CityRepository $cityRepository, DistrictRepository $districtRepository, WardRepository $wardRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
    }

    /**
     * Get all City
     * 
     * @return Model $city
     */
    public function getCity()
    {
        $city = $this->cityRepository->all();
        return $city;
    }

    /**
     * Get district by City Id
     * 
     * @param Request $request
     * 
     * @return Model $district
     */
    public function getDistrict(Request $request)
    {
        $id = $request->city_id;
        $district = $this->districtRepository->getByCity($id);
        return $district;
    }

    /**
     * Get ward by district Id
     * 
     * @param Request $request
     * 
     * @return Model $ward
     */
    public function getWard(Request $request)
    {
        $id = $request->district_id;
        $ward = $this->wardRepository->getByWard($id);

        return $ward;
    }
}
