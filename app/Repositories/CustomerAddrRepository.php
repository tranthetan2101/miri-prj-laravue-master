<?php

namespace App\Repositories;

use App\Models\CustomerAddr;
use App\Models\CustomerDetail;
use App\Repositories\BaseRepository;
use Auth;

/**
 * Class CustomerAddrRepository.
 */
class CustomerAddrRepository extends BaseRepository
{
    /**
     * CustomerAddrRepository constructor.
     *
     * @param  CustomerAddrRepository  $model
     */
    public function __construct(CustomerAddr $model)
    {
        $this->model = $model;
    }
    
    /**
     * Insert data to customerAdress
     * 
     * @return mixed
     */
    public function create($params)
    {
        unset($params['id']);
        return $this->model->create($params);
    }

    /**
     * Update data in customerAdress
     * 
     * @return mixed
     */
    public function update($params)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($params['id']);

        $model->fill($params);

        $model->save();

        return $model;
    }

    public function getByUser()
    {
        return $this->model->where('user_id', Auth::user()->id)->get();
    }
}
