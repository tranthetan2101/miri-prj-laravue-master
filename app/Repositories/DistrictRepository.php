<?php

namespace App\Repositories;

use App\Models\District;
use App\Repositories\BaseRepository;

/**
 * Class DistrictRepository.
 */
class DistrictRepository extends BaseRepository
{
    /**
     * DistrictRepository constructor.
     *
     * @param  District  $model
     */
    public function __construct(District $model)
    {
        $this->model = $model;
    }

    public function getByCity($id)
    {
        return $this->model->where('city_id', '=', $id)->get();
    }

    public function getPaginated($paged, $orderBy = 'id', $orderDir = 'desc', $parent = NULL,  $keyword = NULL)
    {
        $query = $this->model::query();
        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
        if ($parent) {
            $query->where('city_id', $parent);
        }
        return $query->orderBy($orderBy, $orderDir)->paginate($paged);
    }
}
