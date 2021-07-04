<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Combo;
use Illuminate\Support\Facades\DB;

/**
 * Class ComboRepository.
 */
class ComboRepository extends BaseRepository
{
    /**
     * ComboRepository constructor.
     *
     * @param  Combo  $model
     */
    public function __construct(Combo $model)
    {
        $this->model = $model;
    }

    public function getActivePaginated($paged, $orderBy = 'id', $orderDir = 'desc', $keyword = NULL)
    {
        $query = $this->model->with('category');
        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
        return $query->orderBy($orderBy, $orderDir)->paginate($paged);
    }

    public function create(array $data): Combo
    {
        return DB::transaction(
            function () use ($data) {
                $combo = $this->model::create(
                    [
                        'name' => $data['name'],
                        'slug'=> $data['slug'],
                        'description' => $data['description'],
                        'category_id' => $data['category_id'],
                        'sku' => $data['sku'],
                        'stock' => $data['stock'],
                        'image' => $data['image'],
                        'price' => str_replace('.', '', $data['price']),
                        'product_id' => $data['product_id'],
                        'discount_price' => str_replace('.', '', $data['discount_price'])
                    ]
                );
                return $combo;
            }
        );
    }

    public function update(Combo $combo, array $data)
    {
        return DB::transaction(
            function () use ($combo, $data) {
                if ($combo->update(
                    [
                        'name' => $data['name'],
                        'slug' => $data['slug'],
                        'description' => $data['description'],
                        'category_id' => $data['category_id'],
                        'sku' => $data['sku'],
                        'stock' => $data['stock'],
                        'image' => $data['image'],
                        'price' => str_replace('.', '', $data['price']),
                        'product_id' => $data['product_id'],
                        'discount_price' => str_replace('.', '', $data['discount_price'])
                    ]
                )) {
                    return $combo;
                }

                throw new GeneralException(__('Update Combo Error'));
            }
        );
    }

    /**
     * @param Combo $combo
     * @return Combo
     * @throws GeneralException
     */
    public function delete(Combo $combo): Combo
    {
        if ($this->deleteById($combo->id)) {
            return $combo;
        }

        throw new GeneralException('There was a problem deleting this combo. Please try again.');
    }

    public function getByCateId($id)
    {
        return $this->model->where('category_id', '=' ,$id)->first();
    }
}
