<?php

namespace App\Repositories;

use App\Models\Ward;
use App\Repositories\BaseRepository;

/**
 * Class WardRepository.
 */
class WardRepository extends BaseRepository
{
    /**
     * WardRepository constructor.
     *
     * @param  Ward  $model
     */
    public function __construct(Ward $model)
    {
        $this->model = $model;
    }

    public function getByWard($id)
    {
        return $this->model->where('district_id', '=', $id)->get();
    }

    public function getPaginated($paged, $orderBy = 'id', $orderDir = 'desc', $parent = NULL, $keyword = NULL)
    {
        $query = $this->model::query();
        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
        if ($parent) {
            $query->where('district_id', $parent);
        }
        return $query->orderBy($orderBy, $orderDir)->paginate($paged);
    }
}
