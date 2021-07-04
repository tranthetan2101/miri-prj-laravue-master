<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * CategoryRepository constructor.
     *
     * @param  Category  $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Get list Category
     *
     * @return Category
     */
    public function getListCategory()
    {
        return $this->model->with('product')->where('visible', 1)->get();
    }

    /**
     * @param array $data
     *
     * @return Category
     * @throws \Throwable
     * @throws \Exception
     */
    public function create(array $data, $small_img = false, $image = false): Category
    {
        return DB::transaction(
            function () use ($data, $small_img, $image) {
                $picture = null;
                if ($image) {
                    $picture = Storage::put('category', $image);
                }
                $icon = null;
                if ($small_img) {
                    $icon = Storage::put('category', $small_img);
                }
                $category = $this->model::create(
                    [
                        'name' => $data['name'],
                        'slug' => $data['slug'],
                        'visible' => isset($data['visible']) && $data['visible'] === '1',
                        'image' => $picture,
                        'icon' => $icon
                    ]
                );

                if ($category) {
                    return $category;
                }

                throw new GeneralException(__('exceptions.backend.categpry.create_error'));
            }
        );
    }

    public function update(Category $category, array $data, $small_img = false, $image = false)
    {
        return DB::transaction(
            function () use ($category, $data, $small_img, $image) {
                $picture = $category->image;
                if ($image) {
                    $picture = Storage::put('category', $image);
                    // remove old avatar if there is new avatar uploaded
                    Storage::delete($category->image);
                }
                $icon = $category->icon;
                if ($small_img) {
                    $icon = Storage::put('category', $small_img);
                    // remove old avatar if there is new avatar uploaded
                    Storage::delete($category->icon);
                }
                if ($category->update(
                    [
                        'name' => $data['name'],
                        'slug' => $data['slug'],
                        'visible' => isset($data['visible']) && $data['visible'] === '1',
                        'image' => $picture,
                        'icon' => $icon
                    ]
                )) {
                    return $category;
                }

                throw new GeneralException(__('Update Category Error'));
            }
        );
    }

    /**
     * @param Category $category
     * @return Category
     * @throws GeneralException
     */
    public function delete(Category $category): Category
    {
        if ($this->deleteById($category->id)) {
            return $category;
        }

        throw new GeneralException('There was a problem deleting this category. Please try again.');
    }

    /**
     * @param Category $category
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Category $category): bool
    {
        if ($category->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this category. Please try again.'));
    }

    /**
     * @param  Category  $category
     * @param $status
     *
     * @return Category
     * @throws GeneralException
     */
    public function mark(Category $category, $status): Category
    {
        $category->visible = $status;
        if ($category->save()) {
            return $category;
        }
        throw new GeneralException(__('There was a problem updating this category. Please try again.'));
    }

    /**
     * @param  Category $category
     *
     * @throws GeneralException
     * @return  Category
     */
    public function restore( Category $category):  Category
    {
        if ($category->restore()) {
            return $category;
        }

        throw new GeneralException(__('There was a problem restoring this category. Please try again.'));
    }
}
