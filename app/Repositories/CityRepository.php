<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\City;
use App\Repositories\BaseRepository;

/**
 * Class CityRepository.
 */
class CityRepository extends BaseRepository
{
    /**
     * CityRepository constructor.
     *
     * @param  City  $model
     */
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function getPaginated($paged, $orderBy = 'id', $orderDir = 'desc', $parent=NULL, $keyword = NULL)
    {
        $query = $this->model::query();
        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
        if ($parent) {
            $query->where('id', $parent);
        }
        return $query->orderBy($orderBy, $orderDir)->paginate($paged);
    }
}
