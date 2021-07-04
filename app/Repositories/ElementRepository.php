<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Element;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class ElementRepository.
 */
class ElementRepository extends BaseRepository
{
    /**
     * ElementRepository constructor.
     *
     * @param  Element  $model
     */
    public function __construct(Element $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     *
     * @return Element
     * @throws \Throwable
     * @throws \Exception
     */
    public function create(array $data): Element
    {
        return DB::transaction(
            function () use ($data) {
                $element = $this->model::create(
                    [
                        'image' => $data['image'],
                        'name' => $data['name'],
                        'letter' => strtolower(substr($data['name'], 0, 1)),
                        'description' => $data['description'],
                    ]
                );

                if ($element) {
                    return $element;
                }

                throw new GeneralException(__('exceptions.backend.element.create_error'));
            }
        );
    }

    public function update(Element $element, array $data)
    {
        return DB::transaction(
            function () use ($element, $data) {
                if ($element->update(
                    [
                        'image' => $data['image'],
                        'name' => $data['name'],
                        'letter' => strtolower(substr($data['name'], 0, 1)),
                        'description' => $data['description'],
                    ]
                )) {
                    return $element;
                }

                throw new GeneralException(__('Update Element Error'));
            }
        );
    }

    /**
     * @param Element $element
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Element $element): bool
    {
        if ($element->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this element. Please try again.'));
    }

}
