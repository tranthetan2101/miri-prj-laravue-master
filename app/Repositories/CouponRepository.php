<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

/**
 * Class CouponRepository.
 */
class CouponRepository extends BaseRepository
{
    /**
     * CouponRepository constructor.
     *
     * @param  Coupon  $model
     */
    public function __construct(Coupon $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     *
     * @return Coupon
     * @throws \Throwable
     * @throws \Exception
     */
    public function create(array $data): Coupon
    {
        return DB::transaction(
            function () use ($data) {
                $coupon = $this->model::create(
                    [
                        'name' => $data['name'],
                        'code' => strtoupper($data['code']),
                        'slug' => strtoupper($data['code']),
                        'price' => str_replace('.', '', $data['price']),
                        'used_num' => $data['used_num'],
                        'used_num_unlimited' => isset($data['used_num_unlimited']) && $data['used_num_unlimited'] == 1,
                        'period_start' => timezone()->convertFromLocal($data['period_start']),
                        'period_end' => timezone()->convertFromLocal($data['period_end'])
                    ]
                );

                if ($coupon) {
                    return $coupon;
                }

                throw new GeneralException(__('exceptions.backend.coupon.create_error'));
            }
        );
    }

    public function update(Coupon $coupon, array $data)
    {
        return DB::transaction(
            function () use ($coupon, $data) {
                if ($coupon->update(
                    [
                        'name' => $data['name'],
                        'code' => strtoupper($data['code']),
                        'slug' => strtoupper($data['code']),
                        'price' => str_replace('.', '', $data['price']),
                        'used_num' => $data['used_num'],
                        'used_num_unlimited' => isset($data['used_num_unlimited']) && $data['used_num_unlimited'] == 1,
                        'period_start' => timezone()->convertFromLocal($data['period_start']),
                        'period_end' => timezone()->convertFromLocal($data['period_end'])
                    ]
                )) {
                    return $coupon;
                }

                throw new GeneralException(__('Update Coupon Error'));
            }
        );
    }

    /**
     * @param Coupon $coupon
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Coupon $coupon): bool
    {
        if ($coupon->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this coupon. Please try again.'));
    }

    public function getByCode($code)
    {
        return $this->model
                ->where('code','=',$code)
                ->where(function($q) {
                    $q->where('period_start', '<', date('Y-m-d H:i:s'))
                    ->orWhere('period_start', '=', null);
                })
                ->where(function($q) {
                    $q->where('period_end','>',date('Y-m-d H:i:s'))
                    ->orWhere('period_end', '=', null);
                })
                ->where(function($q) {
                    $q->where('used_num', '>', 0)
                    ->orwhere('used_num_unlimited', '=', 1);
                })
                ->first();
    }

}
