<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class BlogRepository.
 */
class BlogRepository extends BaseRepository
{
    /**
     * Blogs constructor.
     *
     * @param  Blog  $model
     */
    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function search($searchTerm)
    {
        return $this->model->where('name', 'LIKE', '%' . $searchTerm . '%')->get();
    }

    /**
     * @param array $data
     *
     * @return Blog
     * @throws \Throwable
     * @throws \Exception
     */
    public function create(array $data, $image = false): Blog
    {
        return DB::transaction(
            function () use ($data, $image) {
                $picture = null;
                if ($image) {
                    $picture = Storage::put('blog', $image);
                }
                $blog = $this->model::create(
                    [
                        'name' => $data['name'],
                        'slug' => $data['slug'],
                        'description' => $data['description'],
                        'data' => $data['data'],
                        'image' => $picture
                    ]
                );

                if ($blog) {
                    return $blog;
                }

                throw new GeneralException(__('exceptions.backend.blog.create_error'));
            }
        );
    }

    public function update(Blog $blog, array $data, $image = false)
    {
        return DB::transaction(
            function () use ($blog, $data, $image) {
                $picture = $blog->image;
                if ($image) {
                    $picture = Storage::put('blog', $image);
                    // remove old avatar if there is new avatar uploaded
                    Storage::delete($blog->image);
                }
                if ($blog->update(
                    [
                        'name' => $data['name'],
                        'slug' => $data['slug'],
                        'description' => $data['description'],
                        'data' => $data['data'],
                        'visible' => isset($data['visible']) && $data['visible'] === '1',
                        'image' => $picture
                    ]
                )) {
                    return $blog;
                }

                throw new GeneralException(__('Update Blog Error'));
            }
        );
    }

    /**
     * @param Blog $blog
     * @return Blog
     * @throws GeneralException
     */
    public function delete(Blog $blog): Blog
    {
        if ($this->deleteById($blog->id)) {
            return $blog;
        }

        throw new GeneralException('There was a problem deleting this blog. Please try again.');
    }

    /**
     * @param Blog $blog
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Blog $blog): bool
    {
        if ($blog->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this blog. Please try again.'));
    }

    /**
     * @param  Blog $blog
     *
     * @throws GeneralException
     * @return  Blog
     */
    public function restore(Blog $blog):  Blog
    {
        if ($blog->restore()) {
            return $blog;
        }

        throw new GeneralException(__('There was a problem restoring this blog. Please try again.'));
    }
}
