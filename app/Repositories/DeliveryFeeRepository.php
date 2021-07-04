<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\DeliveryFee;
use Illuminate\Support\Facades\DB;

/**
 * Class DeliveryFeeRepository.
 */
class DeliveryFeeRepository extends BaseRepository
{
    /**
     * DeliveryFeeRepositoy constructor.
     *
     * @param  DeliveryFee  $model
     */
    public function __construct(DeliveryFee $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     *
     * @return DeliveryFee
     * @throws \Throwable
     * @throws \Exception
     */
    public function create(array $data): DeliveryFee
    {
        return DB::transaction(
            function () use ($data) {

                $delivery_fee = $this->model::create(
                    [
                        'city_id' => $data['city_id'],
                        'district_id' => isset($data['district_id']) ? $data['district_id'] : NULL,
                        'ward_id' => isset($data['ward_id']) ? $data['ward_id'] : NULL,
                        'fee' => str_replace('.', '', $data['fee'])
                    ]
                );

                if ($delivery_fee) {
                    return $delivery_fee;
                }

                throw new GeneralException(__('exceptions.backend.delivery_fee.create_error'));
            }
        );
    }

    public function update(DeliveryFee $delivery_fee, array $data)
    {
        return DB::transaction(
            function () use ($delivery_fee, $data) {
                if ($delivery_fee->update(
                    [
                        'city_id' => $data['city_id'],
                        'district_id' => isset($data['district_id']) ? $data['district_id'] : NULL,
                        'ward_id' => isset($data['ward_id']) ? $data['ward_id'] : NULL,
                        'fee' => str_replace('.', '', $data['fee'])
                    ]
                )) {
                    return $delivery_fee;
                }

                throw new GeneralException(__('Update DeliveryFee Error'));
            }
        );
    }

    /**
     * @param DeliveryFee $delivery_fee
     * @return bool
     * @throws GeneralException
     */
    public function destroy(DeliveryFee $delivery_fee): bool
    {
        if ($delivery_fee->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this delivery_fee. Please try again.'));
    }

    public function getFee($order)
    {
        if ($order->subtotal > setting('free_ship_min_cost', 500000)) {
            return 0;
        }

        $city = $order->shipping->city_id ?? $order->city_id;
        $district = $order->shipping->district_id ?? $order->district_id;
        $ward = $order->shipping->ward_id ?? $order->ward_id;

        $fee = $this->model
                    ->where('city_id', '=', $city)
                    ->where('district_id', '=', $district)
                    ->where('ward_id', '=', $ward)
                    ->first();
        if ($fee) {
            return $fee->fee;
        }

        return setting('default_delivery_fee', 15000);
    }

}
