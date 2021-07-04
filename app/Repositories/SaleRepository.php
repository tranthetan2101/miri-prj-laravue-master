<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Sale;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class SaleRepository.
 */
class SaleRepository extends BaseRepository
{
    /**
     * SaleRepository constructor.
     *
     * @param  Sale  $model
     */
    public function __construct(Sale $model)
    {
        $this->model = $model;
    }

    public function getNewestSale()
    {
        $sales = $this->model->with('sale')->orderBy('created_at')->get();
        foreach ($sales as $sale) {
            // foreach
        }
        return $this->model->with('sale')->orderBy('created_at')->get();
    }

    public function all()
    {
        return $this->model->with('sale')->get();
    }

    public function create(array $data): Sale
    {
        return DB::transaction(
            function () use ($data) {
                $sale = $this->model::create(
                    [
                        'name' => $data['name'],
                        'slug'=> $data['name'],
                        'period_start' => timezone()->convertFromLocal($data['period_start']),
                        'period_end' => timezone()->convertFromLocal($data['period_end']),
                        'sale_amount' => $data['sale_amount'],
                        'type' => $data['type']
                    ]
                );
                // save items
                $sale->products()->sync($data['sale_items']);
                return $sale;
            }
        );
    }

    public function update(Sale $sale, array $data)
    {
        return DB::transaction(
            function () use ($sale, $data) {
                if ($sale->update(
                    [
                            'name' => $data['name'],
                            'slug'=> $data['name'],
                            'period_start' => timezone()->convertFromLocal($data['period_start']),
                            'period_end' => timezone()->convertFromLocal($data['period_end']),
                            'sale_amount' => $data['sale_amount'],
                            'type' => $data['type']
                    ]
                )) {
                    // save items
                    $sale->products()->sync($data['sale_items']);
                    return $sale;
                }

                throw new GeneralException(__('Update Sale Error'));
            }
        );
    }

    public function getSaleRecommend($cart)
    {
        $sales = [];
        foreach($cart->detail as $item)
        {
            if (!empty($item->sale->recommend)) {
                $sales[] = $item->sale;
            }
        }

        return $sales;
    }

    /**
     * @param Sale $sale
     * @return Sale
     * @throws GeneralException
     */
    public function delete(Sale $sale): Sale
    {
        if ($this->deleteById($sale->id)) {
            return $sale;
        }

        throw new GeneralException('There was a problem deleting this sale. Please try again.');
    }

    /**
     * @param Sale $sale
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Sale $sale): bool
    {
        if ($sale->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this sale. Please try again.'));
    }


    /**
     * @param  Sale $sale
     *
     * @throws GeneralException
     * @return  Sale
     */
    public function restore( Sale $sale):  Sale
    {
        if ($sale->restore()) {
            return $sale;
        }

        throw new GeneralException(__('There was a problem restoring this sale. Please try again.'));
    }
}
