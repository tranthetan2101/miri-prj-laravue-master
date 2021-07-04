<?php

namespace App\Repositories;

use App\Models\ReceiveInfo;
use App\Repositories\BaseRepository;

/**
 * Class ReceiveInfoRepository.
 */
class ReceiveInfoRepository extends BaseRepository
{
    /**
     * ReceiveInfoRepository constructor.
     *
     * @param ReceiveInfo $model
     */
    public function __construct(ReceiveInfo $model)
    {
        $this->model = $model;
    }

    /**
     * Insert email to db
     * 
     * @return void
     */
    public function create($param)
    {
        return $this->model->create(['email' => $param['email']]);
    }

    /**
     * Get list ReceiveInfo
     *
     * @return ReceiveInfo
     */
    public function getListEmail()
    {
        return $this->all();
    }
}
