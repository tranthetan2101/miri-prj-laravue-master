<?php

namespace App\Repositories;

use App\Models\CustomerDetail;
use App\Repositories\BaseRepository;
use Auth;

/**
 * Class CustomerDetailRepository.
 */
class CustomerDetailRepository extends BaseRepository
{
    /**
     * CustomerDetailRepository constructor.
     *
     * @param  CustomerDetail  $model
     */
    public function __construct(CustomerDetail $model)
    {
        $this->model = $model;
    }

    /**
     * Get User
     * 
     * @return mixed
     */
    public function getByUser()
    {
        return $this->model->where('user_id', Auth::user()->id)->first();
    }

    /**
     * Update User
     * 
     * @return mixed
     */
    public function updateInfo($data)
    {
        switch ($data['name']) {
            case 'name':
            case 'email':
                Auth::user()->update([$data['name'] => $data['data']]);
                break;
            case 'addr':
                $query = $this->model->newQuery();
                $model = $query->findOrFail($data['id']);

                unset($data['name']);
                unset($data['id']);
                unset($data['_token']);
                
                $model->fill($data);

                $model->save();
            break;
            case 'phone':
            case 'birth':
            default:
                $query = $this->model->newQuery();

                $model = $query->findOrFail($data['id']);

                $model->fill([$data['name'] => $data['data']]);

                $model->save();
                break;
        }

        return null;
    }

    public function createUser($data, $user_id)
    {
        $params = [
            'user_id' => $user_id,
            // 'birth' => '1990-01-01',
            // 'addr_number' => '1',
            // 'addr_street' => 'xxx',
            // 'phone_number' => '00000000',
            // 'city_id' => 1,
            // 'district_id' => 1,
            // 'ward_id' => 1,
        ];

        return $this->model->create($params);
    }
}
